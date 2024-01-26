import {createApp} from "vue";
import "./assets/css/main.css";
import store from "./store";
import router from "./router";
import PrimeVue from 'primevue/config';
import {isAuthObjectValidate} from "./utils/request";
import ToastService from 'primevue/toastservice';
import 'primevue/resources/themes/lara-light-green/theme.css'
import Index from "./component/page/Index.vue";
import Empty from "./component/page/Empty.vue";
import "./utils/calcAppMinHeight";
import {library} from "@fortawesome/fontawesome-svg-core"
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome"
import {fas} from "@fortawesome/free-solid-svg-icons"
import 'primeicons/primeicons.css'
import "primevue/resources/themes/lara-light-indigo/theme.css";


library.add(fas)


function buildComponentIndex() {
    if (isAuthObjectValidate()) {
        return Index;
    }

    return Empty;
}

// Загрузка базовых параметров приложения
store.dispatch("settings/updateAppSettingList").then(e => {
    createApp(buildComponentIndex())
        .use(router)
        .use(store)
        .use(PrimeVue)
        .use(ToastService)
        .component('font-awesome-icon', FontAwesomeIcon)
        .mount('#app')
})

