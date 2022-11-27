var donut = new Morris.Donut({
  element  : 'sales-chart',
  resize   : true,
  colors   : ['#3c8dbc', '#f56954', '#00a65a'],
  data     : [
    { label: 'Download Sales', value: 12 },
    { label: 'In-Store Sales', value: 30 },
    { label: 'Mail-Order Sales', value: 20 }
  ],
  hideHover: 'auto'
});
