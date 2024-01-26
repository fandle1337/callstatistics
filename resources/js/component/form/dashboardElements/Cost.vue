<template>
    <SliderBox v-if="!isLoading">
        <template v-for="(item, index) of edit(costs)" #[`${index}`]>
            <TemplateBoxDefault>
                <TemplateHeaderDefault :theme="theme.THEME_ROYAL_BLUE">
                    Общая стоимость звонков
                </TemplateHeaderDefault>
                <TemplateBodyDefault>
                    {{ currency(item.count, item.currency) }}
                </TemplateBodyDefault>
                <TemplateFooterDefault/>
            </TemplateBoxDefault>
        </template>
    </SliderBox>
    <TemplateBoxDefault v-if="isLoading">
        <TemplateHeaderDefault :theme="theme.THEME_ROYAL_BLUE">
            Общая стоимость звонков
        </TemplateHeaderDefault>
        <TemplateBodyDefault>
            Загружаем данные...
        </TemplateBodyDefault>
        <TemplateFooterDefault/>
    </TemplateBoxDefault>
</template>

<script setup>
import {
    TemplateBoxDefault,
    TemplateFooterDefault,
    TemplateHeaderDefault,
    SliderBox,
    TemplateBodyAnimation, TemplateBodyDefault
} from "skyweb24.vue-dashboard";
import * as dashboard from "skyweb24.vue-dashboard";
import {computed} from "vue";
import {currency} from "../../../utils/format";
import store from "../../../store";

const props = defineProps({
    costs: {
        type: Array
    }
})

const edit = function (costs) {
    if (costs.length < 1) {
        return [{count: 0, currency: 'RUR'}]
    }
    return costs
}

const isLoading = computed(() => store.state.statistics.isLoading)
const theme = computed(() => {
    return dashboard.EnumThemeHeader
})
</script>
