<template>
  <div>
    <div class="flex items-center justify-between mb-3">
      <h1>Buddy</h1>

      <buddy-deploy :route="deployRoute" @onDeployed="onDeployed" />
    </div>

    <div v-if="!hasLoaded" class="flex justify-center">
      <loading-graphic :inline="true" :size="22" />
    </div>

    <div v-if="hasLoaded" class="p-0">
      <ol>
        <li class="card mb-2 p-0" v-for="{ title, items } in logs" :key="title">
          <div class="flex py-2 px-4 gap-2 border-b bg-grey-20 rounded-t">
            <div class="block w-5 text-grey-70">
              <svg-icon name="calendar" class="icon"></svg-icon>
            </div>
            <h2 class="text-base text-grey-80 font-medium">{{ title }}</h2>
          </div>

          <ol>
            <li
              class="flex items-center py-2 px-4 border-b"
              v-for="item in items"
              :key="item.id"
            >
              <div class="text-grey-80">
                <b class="mr-2 text-grey-100">Run #{{ item.id }}</b>
                {{ item.comment }}
              </div>

              <div class="ml-auto flex gap-2 text-grey-70 text-">
                <time :datetime="item.date">{{ item.time }}</time>
                <span
                  class="flex items-center justify-center w-6 h-6 rounded-full"
                >
                  <span
                    class="flex items-center justify-center w-6 h-6 rounded-full text-white"
                    style="padding: 6px"
                    :class="{
                      'bg-green': item.status === 'SUCCESSFUL',
                      'bg-yellow-dark': item.status === 'INPROGRESS',
                      'bg-red': item.status === 'FAILED',
                    }"
                  >
                    <svg-icon
                      v-if="item.status === 'SUCCESSFUL'"
                      name="check"
                      class="icon"
                    ></svg-icon>
                    <svg-icon
                      v-if="item.status === 'FAILED'"
                      name="close"
                      class="icon"
                    ></svg-icon>
                    <loading-graphic
                      v-if="item.status === 'INPROGRESS'"
                      :inline="true"
                      :size="22"
                      text=""
                    />
                  </span>
                </span>
              </div>
            </li>
          </ol>
        </li>
      </ol>
    </div>
  </div>
</template>

<script>
export default {
  props: ["fetchRoute", "deployRoute"],
  data() {
    return {
      hasLoaded: false,
      logs: [],
    };
  },
  computed: {},
  mounted() {
    this.fetch();
  },
  methods: {
    fetch() {
      this.$axios
        .get(this.fetchRoute)
        .then((response) => {
          this.logs = response.data.logs;
          this.hasLoaded = true;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    onDeployed() {
      this.fetch();
    },
  },
};
</script>
