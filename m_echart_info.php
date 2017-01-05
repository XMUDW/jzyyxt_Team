<h class="headline">网站流量</h>
<div class="Split_line"></div>
<div id="echart" style="width: 700px;height:500px;margin-left: 70px;margin-top: 10%;"></div>
<script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
var date = [];
var data = [];
var myChart = echarts.init(document.getElementById('echart'));
        $(document).ready(function() {
			// Calling the plugin
        	 $.getJSON("countSum.json", function(json){
        		
           	  for(var i=0;i<json.length;i++) {
           		 date.push(json[i][0]);
                 data.push(json[i][1]);
                 myChart.setOption(option);
                 
               	  }
           	date = [];
            data = [];
           	});
		});

option = {
    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },
    title: {
        left: 'center',
        text: '讲座预约系统流量图',
    },
    toolbox: {
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: date
    },
    yAxis: {
        type: 'value',
        boundaryGap: [0, '100%']
    },
    dataZoom: [{
        type: 'inside',
        start: 0,
        end: 10
     
    }, {
        start: 0,
        end: 10,
        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
        handleSize: '80%',
        handleStyle: {
            color: '#fff',
            shadowBlur: 3,
            shadowColor: 'rgba(0, 0, 0, 0.6)',
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
    }],
    series: [
        {
        	roam: true,
            name:'浏览人数',
            type:'line',
            smooth:true,
            symbol: 'none',
            sampling: 'average',
            itemStyle: {
                normal: {
                    color: 'rgb(92,172,238)'
                }
            },
            areaStyle: {
                normal: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                        offset: 0,
                        color: 'rgb(91,162,219)'
                    }, {
                        offset: 1,
                        color: 'rgb(255,255,255)'
                    }])
                }
            },
            data: data
        }
    ]
};
    </script>