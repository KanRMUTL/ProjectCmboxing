var ctx = $('.canvas');
var barGraph = []

// ----------------- Chart Start ------------------
// กำหนดช่วงเวลา
var before = $('#before').val()
var after = $('#after').val()
var url = '/api/total'
var time = {
  before: before,
  after: after
}

getChart('/api/total', 'ยอดขาย(บาท)', 'ยอดขายของแต่ละโซน')

function getChart(url, barName, header) {

  $.ajax({
    url: url,
    type: 'GET',
    data: time,
    dataType: 'json',
    success: function (data) {
      chartData = pushData(data, barName)

      barGraph = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: chartData,
        options: {
          title: {
            display: true,
            text: header,
            fontSize: 25
          },
          scales: {
            yAxes: [{
              labelString: 'y'
            }]
          }
        }
      })
    }
  });

}

function pushData(data, barName) {
  var total = []
  var label = []
  for (var i in data) {
    total.push(data[i].total)
    label.push(data[i].label)
  }
  total.push(0)
  chartData = {
    labels: label,
    datasets: [
      {
        label: barName,
        backgroundColor: 'rgba(66, 146, 244, 0.6)',
        borderWidth: 1,
        borderHoverColor: 'rgba(66, 146, 244, 1)',
        borderColor: 'rgba(66, 146, 244, 1)',
        data: total
      }
    ]
  }
  return chartData
}

// ----------- แบ่งตามยอดขาย -------------
$('#sale-total').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  before = $('#before').val()
  after = $('#after').val()
  time = {
    before: before,
    after: after
  }
  getChart('/api/total', 'ยอดขาย(บาท)', 'ยอดขายของแต่ละโซน')
})

// ----------- แบ่งตามจำนวนลูกค้า -------------
$('#sale-amount').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  before = $('#before').val()
  after = $('#after').val()
  time = {
    before: before,
    after: after
  }
  getChart('/api/customer', 'จำนวนลูกค้า(คน)', 'ยอดลูกค้าแต่ละโซน')
})


// ----------- แบ่งตามประเภทบัตร -------------
$('#sale-ticket').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  var before = $('#before').val()
  var after = $('#after').val()
  var time = {
    before: before,
    after: after
  }
  getChart('/api/ticket', 'จำนวนบัตรที่ขายได้(ใบ)', 'ยอดขายแบ่งตามประเภทบัตร')
})

// ----------- แบ่งตามจำนวนลูกค้าสำหรับหัวหน้าโซน -------------
$('#sale-amountcustomer').click(function () {
  barGraph.destroy();
  // กำหนดช่วงเวลา
  before = $('#before').val()
  after = $('#after').val()
  time = {
    before: before,
    after: after
  }
  getChart('/api/amountcustomer', 'จำนวนลูกค้า(คน)', 'ยอดลูกค้าแต่ละโซน')
})