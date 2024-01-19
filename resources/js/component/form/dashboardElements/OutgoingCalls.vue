<template>
    <TemplateBoxDefault>
        <TemplateHeaderDefault :theme="theme.THEME_DRAGON_SKIN">
            Исходящие звонки
        </TemplateHeaderDefault>
        <TemplateBodyDefault>
            {{props.outgoingCalls.count}} ({{toMinuteWithSeconds(props.outgoingCalls.seconds)}})
        </TemplateBodyDefault>
        <TemplateFooterDefault>
            <div :title="'Остальных звонков: ' + (props.totalCalls.count - props.outgoingCalls.count)"
                 class="ui-progressbar ui-progressbar-lg">
                <div class="ui-progressbar-track"
                     style="background-color: var(--ui-progressbar-color-danger);">
                    <div :title="'Исходящих звонков: ' + props.outgoingCalls.count"
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
import {toMinuteWithSeconds} from "../../../utils/format";

const props = defineProps({
    outgoingCalls: {
        type: Object
    },
    totalCalls: {
        type: Object
    }
})
const theme = computed(() => {
    return dashboard.EnumThemeHeader
})

const relation = computed(() => {
    const total = props.totalCalls.count
    const outgoing = props.outgoingCalls.count

    return outgoing / total * 100
})
</script>
