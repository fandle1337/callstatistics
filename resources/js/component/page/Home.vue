<template>
    <Toast/>
    <Preloader :is-loading="isLoading"/>
    <div class="px-3">
        <div class="text-3xl">
            Статистика звонков
        </div>
        <div class="mt-3">
            <Filter/>
        </div>
        <div class="mt-3">
            <Dashboard
                :totalCalls="dashboardData.totalCalls"
                :incomingCalls="dashboardData.incomingCalls"
                :outgoingCalls="dashboardData.outgoingCalls"
                :missedCalls="dashboardData.missedCalls"
                :cost="dashboardData.cost"
            />
        </div>
        <div class="mt-10">
            <div class="text-2xl">
                Хронология звонков
            </div>
            <Graph
                :data="graphData"
            />
        </div>
        <div class="grid grid-flow-col justify-stretch mt-10">
            <div>
                <div class="text-2xl text-center">
                    Ответственные
                </div>
                <Diagram :data="responsibleDiagramData"/>
            </div>
            <div class="">
                <div class="text-2xl text-center">
                    Номера портала
                </div>
                <Diagram :data="numberDiagramData"/>
            </div>
        </div>
        <div class="mt-10">
            <div class="text-2xl">
                Статистика по сотрудникам
            </div>
            <Table
                :data="tableData"
            />
        </div>
        <Popup
            :module-code="moduleCode"
            :domain="domain"
            :user-id="userId"
        />
        <Adv/>
        <Banner
            :module-code="moduleCode"
            :domain="domain"
        />
    </div>
</template>
<script setup>
import {Banner} from "skyweb24.vue-review";
import {Adv} from "skyweb24.vue-adv";
import {Popup} from "skyweb24.vue-review";
import Toast from "../ui/Toast.vue";
import Filter from "../form/Filter.vue";
import Dashboard from "../form/Dashboard.vue";
import Diagram from "../form/Diagram.vue";
import Graph from "../form/Graph.vue";
import Table from "../form/Table.vue";
import {useStore} from "vuex";
import Preloader from "../ui/Preloader.vue";
import {computed} from "vue";

const store = useStore()
const moduleCode = computed(() => store.state.setting.moduleCode)
const domain = computed(() => store.state.setting.domain)
const userId = computed(() => store.state.setting.userId)
const isLoading = computed(() => store.state.statistics.isLoading)
const dashboardData = computed(() => store.state.statistics.dashboardData)
const responsibleDiagramData = computed(() => store.state.statistics.responsibleData)
const numberDiagramData = computed(() => store.state.statistics.numberData)
const graphData = computed(() => store.state.statistics.graphData)
const tableData = computed(() => store.state.statistics.tableData)
const filter = computed(() => store.state.statistics.filter)

store.dispatch('statistics/fetchStatistics', {year: 2023, quarter: 0})
</script>
