<template>
    <div :class="['preloader', {'_show': isLoading}]">
        <ProgressSpinner/>
    </div>
</template>

<script setup>
import ProgressSpinner from "primevue/progressspinner"

const props = defineProps({
    isLoading: {
        type: Boolean
    }
})
</script>

<style>
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    display: none;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, .5);
    z-index: 999;
}

.preloader._show {
    display: flex;
}
</style>