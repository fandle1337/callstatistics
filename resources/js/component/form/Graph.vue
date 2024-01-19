<template>
    <div class="chartdiv" ref="chartdiv"></div>
</template>

<script setup>
import {computed, ref, onMounted} from "vue";
import * as am5 from "@amcharts/amcharts5";
import {color, Theme as am5themes_Animated} from "@amcharts/amcharts5";
import * as am5xy from "@amcharts/amcharts5/xy";

const props = defineProps({
    data: {
        type: Array
    }
})

const chartdiv = ref(null)
const graphData = computed(() => {
    return props.data
})
const createGraph = function () {
    let root = am5.Root.new(chartdiv.value);

    root.setThemes([am5themes_Animated.new(root)]);

    let chart = root.container.children.push(
        am5xy.XYChart.new(root, {
            panY: false,
            layout: root.verticalLayout,
            maxTooltipDistance: 0
        })
    );

    let yRenderer = am5xy.AxisRendererY.new(root, {
        opposite: false
    });


    // Create Y-axis
    let yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
            numberFormat: '#,###',
            maxPrecision: 0,
            renderer: yRenderer
        })
    );

    // Create X-Axis
    let xAxis = chart.xAxes.push(
        am5xy.DateAxis.new(root, {
            baseInterval: {timeUnit: "millisecond", count: 1},
            groupData: true,
            extraMax: 0.01,
            groupInterval: {timeUnit: "month", count: 1},
            tooltip: am5.Tooltip.new(root, {}),

            renderer: am5xy.AxisRendererX.new(root, {})
        })
    );

    xAxis.get("dateFormats")["day"] = "dd.MM";
    xAxis.get("dateFormats")["year"] = "YYYY";
    xAxis.get("dateFormats")["month"] = "MMM YYYY";
    xAxis.get("dateFormats")["week"] = "dd.MM.YYYY";
    xAxis.get("periodChangeDateFormats")["day"] = "dd.MM";
    xAxis.get("periodChangeDateFormats")["month"] = "MMM YYYY";
    xAxis.get("periodChangeDateFormats")["week"] = "dd.MM";

    function createSeries(name, field, color) {
        let series = chart.series.push(
            am5xy.LineSeries.new(root, {
                name: name,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: field,
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {labelText: "{name}: {valueY}"}),
                fill: color,
                stroke: color,
            })
        )
        series.bullets.push(function () {
            return am5.Bullet.new(root, {
                sprite: am5.Circle.new(root, {
                    radius: 5,
                    fill: series.get("fill")
                })
            })
        })
        series.set("fill", color)
        series.strokes.template.set("strokeWidth", 3)
        series.get("tooltip").label.set("text", "[bold]{name}[/]\n{valueX.formatDate()}: {valueY}")
        series.data.setAll(graphData.value)
    }

    createSeries("Входящие звонки", "incoming", color("#0070C0"))
    createSeries("Исходящие звонки", "outgoing", color("#00A300"))
    createSeries("Пропущенные звонки", "missed", color("#ce0d0d"))

    // Add tooltip
    xAxis.set("tooltip", am5.Tooltip.new(root, {
        themeTags: ["axis"]
    }));

    yAxis.set("tooltip", am5.Tooltip.new(root, {
        themeTags: ["axis"]
    }));

    //Add legend
    let legend = chart.children.push(am5.Legend.new(root, {
        x: am5.percent(25),
    }));
    legend.data.setAll(chart.series.values);

    // Add cursor
    chart.set("cursor", am5xy.XYCursor.new(root, {
        behavior: "zoomXY",
        xAxis: xAxis,
    }));
}

onMounted(() => {
    createGraph()
})

</script>

<style scoped>
.chartdiv {
    width: 100%;
    height: 500px;
}
</style>
