import {request} from "../utils/request"
import empty from "../utils/empty"

export default {

    namespaced: true,

    state() {
        return {
            isLoading: false,
            dashboardData: {
                totalCalls: {
                    count: 3,
                    seconds: 1,
                },
                incomingCalls: {
                    count: 1,
                    seconds: 1
                },
                outgoingCalls: {
                    count: 1,
                    seconds: 1
                },
                missedCalls: 1,
                cost: {
                    count: 100.23,
                    currency: 'RUR'
                },
            },
            graphData: [
                {
                    date: 1425157200000,
                    incoming: 25,
                    outgoing: 10,
                    missed: 1

                },
                {
                    date: 1427835600000,
                    incoming: 33,
                    outgoing: 15,
                    missed: 2
                },
                {
                    date: 1430427600000,
                    incoming: 10,
                    outgoing: 5,
                    missed: 3
                },
            ],
            responsibleData: [
                {
                    name: "Анатолий Арсентьев-Рыбаков",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
                {
                    name: "Тест Тестов",
                    count: 100,
                },
                {
                    name: "Иван Иванов",
                    count: 100,
                },
            ],
            numberData: [
                {
                    name: "+7 (923) 123-12-31",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
                {
                    name: "8(800)555-35-35",
                    count: 200
                },
            ],
            tableData: [
                {
                    id: 1,
                    name: "Тест Тестов",
                    totalCalls: 5,
                    incomingCalls: 2,
                    outgoingCalls: 3,
                    totalDuration: 125,
                    averageDuration: 32,
                    maxDuration: 64
                },
                {
                    id: 2,
                    name: "Иван Иванов",
                    totalCalls: 15,
                    incomingCalls: 12,
                    outgoingCalls: 3,
                    totalDuration: 1125,
                    averageDuration: 332,
                    maxDuration: 640
                },
                {
                    id: 1,
                    name: "Тест Тестов",
                    totalCalls: 5,
                    incomingCalls: 2,
                    outgoingCalls: 3,
                    totalDuration: 125,
                    averageDuration: 32,
                    maxDuration: 64
                },
                {
                    id: 2,
                    name: "Иван Иванов",
                    totalCalls: 15,
                    incomingCalls: 12,
                    outgoingCalls: 3,
                    totalDuration: 1125,
                    averageDuration: 332,
                    maxDuration: 640
                },
                {
                    id: 1,
                    name: "Тест Тестов",
                    totalCalls: 5,
                    incomingCalls: 2,
                    outgoingCalls: 3,
                    totalDuration: 125,
                    averageDuration: 32,
                    maxDuration: 64
                },
                {
                    id: 2,
                    name: "Иван Иванов",
                    totalCalls: 15,
                    incomingCalls: 12,
                    outgoingCalls: 3,
                    totalDuration: 1125,
                    averageDuration: 332,
                    maxDuration: 640
                },
                {
                    id: 1,
                    name: "Тест Тестов",
                    totalCalls: 5,
                    incomingCalls: 2,
                    outgoingCalls: 3,
                    totalDuration: 125,
                    averageDuration: 32,
                    maxDuration: 64
                },
                {
                    id: 2,
                    name: "Иван Иванов",
                    totalCalls: 15,
                    incomingCalls: 12,
                    outgoingCalls: 3,
                    totalDuration: 1125,
                    averageDuration: 332,
                    maxDuration: 640
                },
            ],
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
        updateCallList(state, value) {
            state.callList = value
        },
        updateFilter(state, value) {
            state.filter = value
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
    },
    getters: {}
}
