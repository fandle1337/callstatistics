import {request} from "../utils/request"
import empty from "../utils/empty"

export default {

    namespaced: true,

    state() {
        return {
            isLoading: true,
            dashboardData: {
                totalCalls: {
                    count: null,
                    seconds: null,
                },
                incomingCalls: {
                    count: null,
                    seconds: null
                },
                outgoingCalls: {
                    count: null,
                    seconds: null
                },
                missedCalls: null,
                cost: [],
            },
            graphData: [],
            responsibleData: [],
            numberData: [],
            tableData: [],
            analyzeData: {
                totalCallsFromStorage: null,
                totalCallsFromRest: null,
            },
            filter: {
                year: 2023,
                quarter: 0,
            }
        }
    },
    mutations: {
        updateIsLoading(state, value) {
            state.isLoading = value
        },
        updateDashboardData(state, value) {
            state.dashboardData = value
        },
        updateGraphData(state, value) {
            state.graphData = value
        },
        updateResponsibleData(state, value) {
            state.responsibleData = value
        },
        updateNumberData(state, value) {
            state.numberData = value
        },
        updateTableData(state, value) {
            state.tableData = value
        },
        updateFilter(state, value) {
            state.filter = value
        },
        updateAnalyzeData(state, value) {
            state.analyzeData = value
        }
    },
    actions: {
        async fetchStatistics(context, payload) {
            return request("/api/app/statistics/list", {
                headers: {
                    "Content-Type": "application/json"
                },
                method: "POST",
                body: JSON.stringify(payload)
            })
        },
        async deleteAllRecords(context, payload) {
            return request("/api/app/statistics/delete", {
                method: "GET"
            })
        },
        async updateStatisticsList(context, payload) {
            const response = await context.dispatch("fetchStatistics", payload)
            context.commit("updateDashboardData", response?.dashboard_stats)
            context.commit("updateGraphData", response?.graph_stats)
            context.commit("updateResponsibleData", response?.responsible_stats)
            context.commit("updateNumberData", response?.number_stats)
            context.commit("updateTableData", response?.table_stats)
            context.commit("updateAnalyzeData", response?.analyze_stats)
        },

    },
    getters: {}
}
