import {createStore, mapState} from "vuex";
import Setting from "./store/Settings.js";
import Statistics from "./store/Statistics.js";

export default createStore({
    modules: {
        setting: Setting,
        statistics: Statistics
    },
    actions: {

    },
    getters: {
        PLACEMENT_OPTIONS() {
            return PLACEMENT_OPTIONS
        },
        AUTH_OBJECT() {
            return AUTH_OBJECT
        }
    }
})
