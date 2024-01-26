<template>
    <div :class="['ui-progressbar', 'ui-progressbar-bg', (progressPercentage < 49) ? 'ui-progressbar-danger':
        (progressPercentage > 99 ? 'ui-progressbar-success' : 'ui-progressbar-warning')]">
        <div class="ui-progressbar-text-before">{{ text }}</div>
        <div class="ui-progressbar-track">
            <div class="ui-progressbar-bar" :style="'width:'+ progressPercentage + '%;'"></div>
        </div>
        <div class="ui-progressbar-text-after">{{ totalCallsFromStorage }} из {{ totalCallsFromRest }}</div>
    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
    totalCallsFromStorage: {
        type: Number
    },
    totalCallsFromRest: {
        type: Number
    },
    text: {
        type: String
    }
})
const progressPercentage = computed(() => {
    return (props.totalCallsFromStorage / props.totalCallsFromRest) * 100
})
</script>

<style scoped>

</style>
