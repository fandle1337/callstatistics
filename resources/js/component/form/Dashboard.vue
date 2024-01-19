<template>
    <Grid :col="4">
        <template #key1>
            <TotalCalls
                :total-calls="props.totalCalls"
                :missed-calls="props.missedCalls"
            />
        </template>
        <template #key2>
            <IncomingCalls
                :incoming-calls="props.incomingCalls"
                :total-calls="props.totalCalls"
            />
        </template>
        <template #key3>
            <OutgoingCalls
                :outgoing-calls="props.outgoingCalls"
                :total-calls="props.totalCalls"
            />
        </template>
        <template #key4>
            <Cost
                :cost="props.cost"
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

const props = defineProps({
    totalCalls: {
        count: {
            type: Number
        },
        seconds: {
            type: Number
        }
    },
    incomingCalls: {
        count: {
            type: Number
        },
        seconds: {
            type: Number
        }
    },
    outgoingCalls: {
        count: {
            type: Number
        },
        seconds: {
            type: Number
        }
    },
    missedCalls: {
        type: Number
    },
    cost: {
        count: {
            type: Number
        },
        currency: {
            type: Number
        }
    }
})

const store = useStore()

</script>
