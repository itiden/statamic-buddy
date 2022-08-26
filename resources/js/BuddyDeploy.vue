<template>
  <div>
    <button
      :disabled="disabled"
      class="btn-primary"
      :class="{ 'btn-disabled': disabled }"
      @click="open"
    >
      Deploy
    </button>

    <stack narrow name="buddy-deploy" v-if="show">
      <div class="bg-white h-full">
        <div
          class="bg-grey-20 px-3 py-1 border-b border-grey-30 text-lg font-medium flex items-center justify-between"
        >
          <h2 class="text-lg font-medium">Deploy</h2>
          <button
            type="button"
            class="btn-close"
            @click="close"
            v-html="'&times'"
          />
        </div>

        <form @submit="confirm">
          <div class="p-3">
            <label class="font-bold mb-1" for="buddy-comment">{{
              __("Comment")
            }}</label>
            <textarea-input
              :id="buddy - comment"
              :name="comment"
              :focus="true"
              :disabled="loading"
              @input="handleChange"
            />
          </div>
        </form>

        <div class="p-3" v-if="!loading">
          <button
            :disabled="loading"
            @click="confirm"
            class="btn-primary w-full"
            :class="{ 'btn-disabled': loading }"
          >
            {{ __("Submit") }}
          </button>
        </div>

        <div class="p-3 flex justify-center" v-if="loading">
          <loading-graphic
            :size="14"
            :inline="true"
            :color="white"
            text="Deploying"
          />
        </div>
      </div>
    </stack>

    <confirmation-modal
      v-if="confirming"
      title="Deploy your site"
      bodyText="Are you sure you want to deploy your site?"
      buttonText="Deploy"
      @confirm="submit()"
      @cancel="confirming = false"
    />
  </div>
</template>

<script>
export default {
  props: {
    disabled: Boolean,
    route: String,
  },
  data() {
    return {
      confirming: false,
      show: false,
      loading: false,
      value: "",
    };
  },
  computed: {},
  methods: {
    open() {
      this.show = true;
    },
    close() {
      this.show = false;
    },
    confirm() {
      this.confirming = true;
    },
    handleChange(value) {
      this.value = value;
    },
    submit() {
      this.loading = true;
      this.confirming = false;

      this.$axios
        .post(this.route, { comment: this.value })
        .then((response) => {
          this.loading = false;
          this.show = false;

          this.$toast.success(__("Site is now being deployed."));
          this.$emit("onDeployed");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
