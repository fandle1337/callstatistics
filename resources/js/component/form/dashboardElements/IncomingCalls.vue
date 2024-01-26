<template>
    <TemplateBoxDefault>
        <TemplateHeaderDefault :theme="theme.THEME_DEEP_ROSE">
            Входящие звонки
        </TemplateHeaderDefault>
        <TemplateBodyDefault>
            <div v-if="isLoading">
                Загружаем данные...
            </div>
            <div v-else>
                {{props.incomingCalls.count.toLocaleString()}} ({{toMinute(props.incomingCalls.seconds)}})
            </div>
        </TemplateBodyDefault>
        <TemplateFooterDefault>
            <div :title="'Остальных звонков: ' + (props.totalCalls.count - props.incomingCalls.count)"
                 class="ui-progressbar ui-progressbar-lg">
                <div class="ui-progressbar-track"
                     style="background-color: var(--ui-progressbar-color-danger);">
                    <div :title="'Входящих звонков: ' + props.incomingCalls.count"
                         class="ui-progressbar-bar"
                         :style="'width: ' + relation + '%; background-color: var(--green-500);'">
                    </div>
                </div>
            </div>
        </TemplateFooterDefault>
    </TemplateBoxDefault>
</template>

<script setup>
import {TemplateBoxDefault, TemplateBodyDefault, TemplateFooterDefault, TemplateHeaderDefault} from "skyweb24.vue-dashboard";
import * as dashboard from "skyweb24.vue-dashboard";
import {computed} from "vue";
import {toMinute} from "../../../utils/format";
import store from "../../../store";

const props = defineProps({
    incomingCalls: {
        type: Object
    },
    totalCalls: {
        type: Object
    }
})
const isLoading = computed(() => store.state.statistics.isLoading)
const theme = computed(() => {
    return dashboard.EnumThemeHeader
})

const relation = computed(() => {
    const total = props.totalCalls.count
    const incoming = props.incomingCalls.count

    return incoming / total * 100
})
</script>
