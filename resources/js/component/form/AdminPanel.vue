<template>
    <Toast ref="refToast"/>
    <Button
        :class="['ui-btn', 'ui-btn-danger', {'ui-btn-wait': isWaiting}, {'ui-btn-disabled': isWaiting}]"
        @click="update"
        label="Пересчитать данные"
    />
    <Message
        class="w-[50vw]"
        :severity="'error'"
        :closable="false">
        <template #messageicon>
        </template>
        <span class="">
            Обратите внимание! При нажатии на кнопку "Пересчитать данные", приложение произведет
            обнуление всех ранее добавленных данных и начнет обсчет заново. Прибегайте к данной опции только при
            глобальных изменениях данных на портале.
        </span>
    </Message>
</template>

<script setup>
import Toast from "../ui/Toast.vue";
import Button from "primevue/button";
import Message from "primevue/message";
import {computed, ref} from "vue";
import store from "../../store";

const refToast = ref(null)
const isWaiting = ref(false)
const isLoading = computed(() => store.state.statistics.isLoading)
const filter = computed(() => store.state.statistics.filter)
const update = function () {
    if (confirm('Вы уверены, что хотите пересчитать данные?')) {
        isWaiting.value = true
        store.dispatch("statistics/deleteAllRecords").then((e) => {
            if (e) {
                refToast.value.show(
                    'success',
                    'Ваши данные успешно удалены!',
                    'Теперь они будут постепенно загружаться.',
                )
            }
            if (!e) {
                refToast.value.show(
                    'error',
                    'Упс!',
                    'Что-то пошло не так.',
                )
            }
            isWaiting.value = false
        }).then(() => {
            store.commit("statistics/updateIsLoading", true)
            store.dispatch("statistics/updateStatisticsList", {
                year: filter.value.year,
                quarter: filter.value.quarter
            }).then(() => {
                store.commit("statistics/updateIsLoading", false)
            })
        })
    }
}
</script>

<style scoped>
.p-message .p-message-icon {
    display: none;
}
</style>
