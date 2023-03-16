import AppListing from '../app-components/Listing/AppListing';

Vue.component('organisation-listing', {
    mixins: [AppListing],

    data() {
        return {
            showSubscribedsFilter: true,
            subscribedsMultiselect: '',

            filters: {
                subscribeds: [],
            },
        }
    },

    watch: {
        showSubscribedsFilter: function (newVal, oldVal) {
            this.subscribedsMultiselect = [];
        },
        subscribedsMultiselect: function(newVal, oldVal) {
            this.filters.subscribedsMultiselect = newVal.map(function(object) { return object['value']; });
            this.filter('subscribeds', this.filters.subscribedsMultiselect);
        }
    }
});