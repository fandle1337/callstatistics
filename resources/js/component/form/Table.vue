<template>
    <DataTable :value="props.data"
               sortField="totalCalls"
               :sortOrder="-1"
               scrollable
               scrollHeight="400px"
               showGridlines
               stripedRows
               tableStyle="min-width: 50rem">
        <Column field="name" header="Пользователь" frozen :sortable="true">
            <template #body="slotProps">
                <a :href="'https://' + domain + '/company/personal/user/' + slotProps.data.id">{{ slotProps.data.name }}</a>
            </template>
        </Column>
        <Column field="totalCalls" header="Всего звонков" :sortable="true"/>
        <Column field="incomingCalls" header="Входящих звонков" :sortable="true"/>
        <Column field="outgoingCalls" header="Исходящих звонков" :sortable="true"/>
        <Column field="totalDuration" header="Общая продолжительность" :sortable="true"/>
        <Column field="averageDuration" header="Средняя продолжительность" :sortable="true"/>
        <Column field="maxDuration" header="Наибольшая продолжительность" :sortable="true"/>
    </DataTable>
</template>

<script setup>
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore()
const props = defineProps({
    data: {
        type: Array
    }
})
const domain = computed(() => store.state.setting.domain)

</script>

