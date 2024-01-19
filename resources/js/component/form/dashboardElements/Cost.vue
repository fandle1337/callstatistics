<template>
    <TemplateBoxDefault>
        <TemplateHeaderDefault :theme="theme.THEME_ROYAL_BLUE">
            Общая стоимость звонков
        </TemplateHeaderDefault>
        <TemplateBodyDefault>
            {{currency(props.cost.count, props.cost.currency)}}
        </TemplateBodyDefault>
    </TemplateBoxDefault>
</template>

<script setup>
import {TemplateBoxDefault, TemplateBodyDefault, TemplateFooterDefault, TemplateHeaderDefault} from "skyweb24.vue-dashboard";
import * as dashboard from "skyweb24.vue-dashboard";
import {computed} from "vue";
import {currency} from "../../../utils/format";

const props = defineProps({
    cost: {
        type: Object
    }
})
const theme = computed(() => {
    return dashboard.EnumThemeHeader
})
</script>
