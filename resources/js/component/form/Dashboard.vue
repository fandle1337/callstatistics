<template>
    <Grid :col="4">
        <template #key1>
            <TotalCalls
                :total-calls="dashboardData.totalCalls"
                :missed-calls="dashboardData.missedCalls"
            />
        </template>
        <template #key2>
            <IncomingCalls
                :incoming-calls="dashboardData.incomingCalls"
                :total-calls="dashboardData.totalCalls"
            />
        </template>
        <template #key3>
            <OutgoingCalls
                :outgoing-calls="dashboardData.outgoingCalls"
                :total-calls="dashboardData.totalCalls"
            />
        </template>
        <template #key4>
            <Cost
                :costs="dashboardData.cost"
            />
        </template>
    </Grid>
</template>

<script setup>
import {Grid} from "skyweb24.vue-dashboard";
import {useStore} from "vuex";
import TotalCalls from "./dashboardElements/TotalCalls.vue";
import IncomingCalls from "./dashboardElements/IncomingCalls.vue";
import Cost from "./dashboardElements/Cost.vue";
import OutgoingCalls from "./dashboardElements/OutgoingCalls.vue";
import {computed} from "vue";

const store = useStore()
const dashboardData = computed(() => store.state.statistics.dashboardData)


</script>
