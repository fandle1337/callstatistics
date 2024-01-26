import {createStore, mapState} from "vuex";
import Settings from "./store/Settings.js";
import Statistics from "./store/Statistics.js";

export default createStore({
    modules: {
        settings: Settings,
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
