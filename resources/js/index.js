import BuddyDeploy from './BuddyDeploy.vue';
import BuddyLog from './BuddyLog.vue';

Statamic.booting(() => {
    Statamic.$components.register('buddy-log', BuddyLog);
    Statamic.$components.register('buddy-deploy', BuddyDeploy);
});
