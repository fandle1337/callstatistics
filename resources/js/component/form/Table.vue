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
                <a target="_blank" :href="'https://' + domain + '/company/personal/user/' + slotProps.data.id +'/'">{{ slotProps.data.name }}</a>
            </template>
        </Column>
        <Column field="totalCalls" header="Всего звонков" :sortable="true">
            <template #body="slotProps">
                {{ slotProps.data.totalCalls.toLocaleString() }}
            </template>
        </Column>>
        <Column field="incomingCalls" header="Входящих звонков" :sortable="true">
            <template #body="slotProps">
                {{ slotProps.data.incomingCalls.toLocaleString() }}
            </template>
        </Column>
        <Column field="outgoingCalls" header="Исходящих звонков" :sortable="true">
            <template #body="slotProps">
                {{ slotProps.data.outgoingCalls.toLocaleString() }}
            </template>
        </Column>
        <Column field="missedCalls" header="Пропущенных звонков" :sortable="true">
            <template #body="slotProps">
                {{ slotProps.data.missedCalls.toLocaleString() }}
            </template>
        </Column>
        <Column field="totalDuration" header="Общая продолжительность" :sortable="true">
            <template #body="slotProps">
                {{ formatTime(slotProps.data.totalDuration) }}
            </template>
        </Column>
        <Column field="averageDuration" header="Средняя продолжительность" :sortable="true">
            <template #body="slotProps">
                {{ formatTime(slotProps.data.averageDuration) }}
            </template>
        </Column>
        <Column field="cost" header="Сумма расходов" :sortable="true">
            <template #body="slotProps">
                {{ currency(slotProps.data.cost, 'RUR') }}
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import {useStore} from "vuex";
import {computed} from "vue";
import {currency, formatTime} from "../../utils/format";

const store = useStore()
const props = defineProps({
    data: {
        type: Array
    }
})
const domain = computed(() => store.state.settings.domain)

</script>

