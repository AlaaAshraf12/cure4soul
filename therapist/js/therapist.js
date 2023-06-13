const form = document.getElementById('schedule-form');
      
form.addEventListener('submit', function(event) {
  event.preventDefault();
  const startDate = document.getElementById('start-date').value;
  const endDate = document.getElementById('end-date').value;
  const days = Array.from(document.getElementsByName('days'))
    .filter(day => day.checked)
    .map(day => day.value);
  const startTime = document.getElementById('start-time').value;
  const endTime = document.getElementById('end-time').value;
  const schedule = { startDate, endDate, days, startTime, endTime };
