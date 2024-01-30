<template>
    <div class="chartdiv" ref="chartdiv"></div>
</template>

<script setup>
import {computed, onMounted, ref, toRaw, watch} from "vue";
import * as am5 from "@amcharts/amcharts5";
import {color, Theme as am5themes_Animated} from "@amcharts/amcharts5";
import * as am5xy from "@amcharts/amcharts5/xy";
import store from "../../store";

const chartdiv = ref(null)
let rootChart = null
const graphData = computed(() => store.state.statistics.graphData)
const createGraph = function () {
    rootChart = am5.Root.new(chartdiv.value);

    rootChart.setThemes([am5themes_Animated.new(rootChart)])

    let chart = rootChart.container.children.push(
        am5xy.XYChart.new(rootChart, {
            panY: false,
            layout: rootChart.verticalLayout,
            maxTooltipDistance: 0
        })
    )

    const yRenderer = am5xy.AxisRendererY.new(rootChart, {
        opposite: false
    })

    const yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(rootChart, {
            numberFormat: '#,###',
            maxPrecision: 0,
            renderer: yRenderer
        })
    );

    const xAxis = chart.xAxes.push(
        am5xy.DateAxis.new(rootChart, {
            baseInterval: {timeUnit: "millisecond", count: 1},
            groupData: true,
            extraMax: 0.01,
            groupInterval: {timeUnit: "month", count: 1},
            tooltip: am5.Tooltip.new(rootChart, {}),
            renderer: am5xy.AxisRendererX.new(rootChart, {})
        })
    )

    xAxis.get("dateFormats")["day"] = "dd.MM";
    xAxis.get("dateFormats")["year"] = "YYYY";
    xAxis.get("dateFormats")["month"] = "MMM YYYY";
    xAxis.get("dateFormats")["week"] = "dd.MM.YYYY";
    xAxis.get("periodChangeDateFormats")["day"] = "dd.MM";
    xAxis.get("periodChangeDateFormats")["month"] = "MMM YYYY";
    xAxis.get("periodChangeDateFormats")["week"] = "dd.MM";

    function createSeries(name, field, color) {
        const series = chart.series.push(
            am5xy.LineSeries.new(rootChart, {
                name: name,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: field,
                valueXField: "date",
                tooltip: am5.Tooltip.new(rootChart, {labelText: "{name}: {valueY}"}),
                fill: color,
                stroke: color,
            })
        )
        series.bullets.push(function () {
            return am5.Bullet.new(rootChart, {
                sprite: am5.Circle.new(rootChart, {
                    radius: 5,
                    fill: series.get("fill")
                })
            })
        })
        series.set("fill", color)
        series.strokes.template.set("strokeWidth", 3)
        series.get("tooltip").label.set("text", "[bold]{name}[/]\n{valueX.formatDate()}: {valueY}")

        series.data.setAll(toRaw(graphData.value))
    }

    createSeries("Входящие звонки", "incoming", color("#0070C0"))
    createSeries("Исходящие звонки", "outgoing", color("#00A300"))
    createSeries("Пропущенные звонки", "missed", color("#ce0d0d"))

    xAxis.set("tooltip", am5.Tooltip.new(rootChart, {
        themeTags: ["axis"]
    }));

    yAxis.set("tooltip", am5.Tooltip.new(rootChart, {
        themeTags: ["axis"]
    }));

    const legend = chart.children.push(am5.Legend.new(rootChart, {
        x: am5.percent(25),
    }));
    legend.data.setAll(chart.series.values);

    chart.set("cursor", am5xy.XYCursor.new(rootChart, {
        behavior: "zoomXY",
        xAxis: xAxis,
    }));
}

onMounted(() => {
    createGraph()
})

watch(graphData, () => {
    if (rootChart) {
        rootChart.dispose()
    }
    createGraph()
})

</script>

<style scoped>
.chartdiv {
    width: 100%;
    height: 500px;
}
</style>
