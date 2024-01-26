<template>
    <Dropdown
        class="min-w-[10rem]"
        :model-value="year"
        :options="yearList"
        optionLabel="name"
        placeholder="Выберите отчетный год"
        @update:model-value="updateYear"
    />
    <Dropdown

        v-if="year"
        class="ml-3 min-w-[10rem]"
        :model-value="quarter"
        :options="quarterList"
        optionLabel="name"
        placeholder="Выберите квартал"
        @update:model-value="updateQuarter"
    />
    <Button
        class="ml-3"
        label="Применить"
        @click="submit"
    />
</template>

<script setup>
import Dropdown from "primevue/dropdown";
import Button from "primevue/button";
import {useStore} from "vuex";
import {ref, computed} from "vue";

const store = useStore()
const filter = computed(() => store.state.statistics.filter)

const yearList = computed(() => {
    const currentYear = new Date().getFullYear()
    const years = []

    for (let i = 0; i < 5; i++) {
        const yearValue = currentYear - i
        years.push({
            code: yearValue,
            name: `${yearValue} год`,
        })
    }
    return years
})
const year = ref({
    code: filter.value.year ?? new Date().getFullYear(),
    name: filter.value.year + ' год' ?? new Date().getFullYear() + ' год'
})
const updateYear = (event) => {
    year.value = event
}

const quarter = ref({
    code: filter.value.quarter ?? 0,
    name: filter.value.quarter === 0 ? 'Весь год' : `${filter.value.quarter} квартал`
})

const quarterList = computed(() => {
    return [
        {
            code: 0,
            name: 'Весь год'
        },
        {
            code: 1,
            name: '1 квартал'
        },
        {
            code: 2,
            name: '2 квартал'
        },
        {
            code: 3,
            name: '3 квартал'
        },
        {
            code: 4,
            name: '4 квартал'
        },
    ]
})
const updateQuarter = (event) => {
    quarter.value = event
}
const submit = () => {
    store.commit('statistics/updateIsLoading', true)
    store.dispatch('statistics/updateStatisticsList', {
        year: year.value.code,
        quarter: quarter.value.code
    }).then(() => {
        store.commit('statistics/updateIsLoading', false)
    })
}
</script>
