<template>
    <div class="chartdiv" ref="chartdiv"></div>
</template>

<script setup>
import {ref, computed, onMounted} from "vue";
import {Theme as am5themes_Animated} from "@amcharts/amcharts5";
import * as am5 from "@amcharts/amcharts5";
import * as am5percent from "@amcharts/amcharts5/percent";
import * as am5plugins_sliceGrouper from "@amcharts/amcharts5/.internal/plugins/sliceGrouper/SliceGrouper";
const props = defineProps({
    data: {
        type: Array,
    }
})

const chartdiv = ref(null)
const diagramData = computed(() => {
    return props.data
})
const createChart = function () {
    const root = am5.Root.new(chartdiv.value)

    root.setThemes([am5themes_Animated.new(root)])

    const chart = root.container.children.push(
        am5percent.PieChart.new(root, {
            endAngle: 270,
            radius: am5.percent(70),
            layout: root.horizontalLayout,
        })
    )

    // Create series
    const series = chart.series.push(
        am5percent.PieSeries.new(root, {
            valueField: "count",
            categoryField: "name",
            endAngle: 270
        })
    )

    series.states.create("hidden", {
        endAngle: -90
    })

    // Set data
    series.data.setAll(diagramData.value)
    series.labels.template.set("forceHidden", true)
    series.ticks.template.set("forceHidden", true)
    series.appear(1000, 100)

    // Set legend
    const initialX = function (width) {
        if (width < 1000) {
            return am5.percent(45)
        }
    }
    const initialX1 = window.innerWidth > 1230 ? am5.percent(61) : am5.percent(55)
    const legend = chart.children.push(am5.Legend.new(root, {
        // x: initialX(window.innerWidth),
        y: am5.percent(25),
        layout: root.verticalLayout,
        height: am5.percent(50),
        verticalScrollbar: am5.Scrollbar.new(root, {
            orientation: "vertical"
        })
    }))

    legend.labels.template.setAll({
        fontSize: 15,
        fontWeight: "300"
    })

    legend.valueLabels.template.setAll({
        fontSize: 15,
        fontWeight: "400"
    })

    legend.markerRectangles.template.setAll({
        cornerRadiusTL: 10,
        cornerRadiusTR: 10,
        cornerRadiusBL: 10,
        cornerRadiusBR: 10
    })

    legend.data.setAll(series.dataItems)

    const grouper = am5plugins_sliceGrouper.SliceGrouper.new(root, {
        series: series,
        legend: legend,
        clickBehavior: "break",
        threshold: 1,
        groupName: "Другие"
    })
}

onMounted(() => {
    createChart()
})
</script>
<style>
.chartdiv {
    width: 100%;
    height: 500px;
}
</style>
