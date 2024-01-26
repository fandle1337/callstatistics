<template>
    <div class="chartdiv" ref="chartdiv"></div>
</template>

<script setup>
import {ref, computed, onMounted, watch} from "vue";
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
let rootChart = null
const diagramData = computed(() => {
    return props.data
})
const createChart = function () {
    rootChart = am5.Root.new(chartdiv.value)

    rootChart.setThemes([am5themes_Animated.new(rootChart)])

    const chart = rootChart.container.children.push(
        am5percent.PieChart.new(rootChart, {
            endAngle: 270,
            radius: am5.percent(70),
            layout: rootChart.horizontalLayout,
        })
    )

    const series = chart.series.push(
        am5percent.PieSeries.new(rootChart, {
            valueField: "count",
            categoryField: "name",
            endAngle: 270,
            legendLabelText: "{name}",
            legendValueText: "[bold {fill}]{count} зв.[/]"
        })
    )

    series.states.create("hidden", {
        endAngle: -90
    })

    series.data.setAll(diagramData.value)
    series.labels.template.set("forceHidden", true)
    series.ticks.template.set("forceHidden", true)
    series.appear(1000, 100)

    const legend = chart.children.push(am5.Legend.new(rootChart, {
        y: am5.percent(25),
        layout: rootChart.verticalLayout,
        height: am5.percent(50),
        verticalScrollbar: am5.Scrollbar.new(rootChart, {
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

    const categoriesWithLessThanOnePercent = series.dataItems.filter(item => {
        const values = item.values
        return values && values.has("value") && values.get("value") < 1
    })

    if (categoriesWithLessThanOnePercent.length >= 2) {
        const grouper = am5plugins_sliceGrouper.SliceGrouper.new(rootChart, {
            series: series,
            legend: legend,
            clickBehavior: "break",
            threshold: 1,
            groupName: "Другие"
        })
    }
}
onMounted(() => {
    createChart()
})

watch(diagramData, () =>{
    if (rootChart) {
        rootChart.dispose()
    }
    createChart()
})
</script>
<style>
.chartdiv {
    width: 100%;
    height: 500px;
}
</style>
