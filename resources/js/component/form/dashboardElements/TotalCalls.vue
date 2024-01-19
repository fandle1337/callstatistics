<template>
    <TemplateBoxDefault>
        <TemplateHeaderDefault :theme="theme.THEME_AQUA_VELVET">
            Всего звонков
        </TemplateHeaderDefault>
        <TemplateBodyDefault>
            {{props.totalCalls.count}} ({{toMinuteWithSeconds(props.totalCalls.seconds)}})
        </TemplateBodyDefault>
        <TemplateFooterDefault>
            <div :title="'Пропущенных звонков: ' + props.missedCalls"
                 class="ui-progressbar ui-progressbar-lg">
                <div class="ui-progressbar-track"
                     style="background-color: var(--ui-progressbar-color-danger);">
                    <div :title="'Остальных звонков: ' + (props.totalCalls.count - props.missedCalls)"
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
import {toMinuteWithSeconds} from "../../../utils/format.js";

const props = defineProps({
    totalCalls: {
        type: Object
    },
    missedCalls: {
        type: Number
    }
})
const theme = computed(() => {
    return dashboard.EnumThemeHeader
})

const relation = computed(() => {
    const total = props.totalCalls.count
    const missed = props.missedCalls

    return 100 - missed / total * 100
})

</script>
