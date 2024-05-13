// --------- Panel Switching ---------
{
  document.getElementById("admin_tab-home").classList.add("d-block");

  document.getElementById("admin_btn_home").onclick = function () {
    document.getElementById("admin_tab-classroom").classList.remove("d-block");
    document.getElementById("admin_tab-Users").classList.remove("d-block");
    document.getElementById("admin_tab-home").classList.add("d-block");
  }

  document.getElementById("admin_btn_classroom").onclick = function () {
    document.getElementById("admin_tab-home").classList.remove("d-block");
    document.getElementById("admin_tab-Users").classList.remove("d-block");
    document.getElementById("admin_tab_classroom_addClass").classList.add("d-block");
    document.getElementById("admin_tab-classroom").classList.add("d-block");
  }

  // --------- Classroom Panel sub panels Switching ---------
  {
    document.getElementById("btn_admin_addUser_Class").onclick = function () {
      document.getElementById("admin_tab_classroom_addClass").classList.remove("d-block");
      document.getElementById("admin_tab_classroom_AddSubjectsClass").classList.remove("d-block");
      document.getElementById("admin_tab_classroom_AddUsersClass").classList.add("d-block");
    }
    document.getElementById("btn_admin_addclass_Class").onclick = function () {
      document.getElementById("admin_tab_classroom_AddUsersClass").classList.remove("d-block");
      document.getElementById("admin_tab_classroom_AddSubjectsClass").classList.remove("d-block");
      document.getElementById("admin_tab_classroom_addClass").classList.add("d-block");
    }
    document.getElementById("btn_admin_addSubjects_Class").onclick = function () {
      document.getElementById("admin_tab_classroom_addClass").classList.remove("d-block");
      document.getElementById("admin_tab_classroom_AddUsersClass").classList.remove("d-block");
      document.getElementById("admin_tab_classroom_AddSubjectsClass").classList.add("d-block");
    }
  }

  document.getElementById("admin_btn_Users").onclick = function () {
    document.getElementById("admin_tab-classroom").classList.remove("d-block");
    document.getElementById("admin_tab-home").classList.remove("d-block");
    document.getElementById("admin_tab-Users").classList.add("d-block");
    document.getElementById("admin_tab_addUser_User").classList.add("d-block");
  }

  {
    document.getElementById("btn_admin_addUser_users").onclick = function () {
      document.getElementById("admin_tab_updateUser_User").classList.remove("d-block");
      document.getElementById("admin_tab_addUser_User").classList.add("d-block");
    }

    document.getElementById("btn_admin_updateUser_users").onclick = function () {
      document.getElementById("admin_tab_addUser_User").classList.remove("d-block");
      document.getElementById("admin_tab_updateUser_User").classList.add("d-block");
    }

  }
}

// --------- Charts ---------
{
  // --------- Users in School chart ---------
  {
    fetch('../../src/controllers/userReport.php?school_id=1')
        .then(response => response.json())
        .then(data => {
          console.log(data);
          updateChart(data);
        })
        .catch(error => console.log('Error:', error));

    var barColors = ["red", "green", "blue", "orange", "brown"];

    function updateChart(data) {
      // Extract labels and counts from the fetched data
      var xValues = Object.keys(data);
      var yValues = Object.values(data);

      // If there is already a chart instance, destroy it before creating a new one
      if (window.myChart) {
        window.myChart.destroy();
      }

      // Create a new chart instance
      window.myChart = new Chart("users", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
            backgroundColor: barColors,
            data: yValues
          }]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: "Users in School"
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true  // Ensures that the bar chart starts at zero
              }
            }]
          }
        }
      });
    }



    // --------- School Marks Progress chart ---------
    {

        const ctx = document.getElementById('progress').getContext('2d');
        let myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [],
            datasets: [{
              label: 'Average Marks',
              fill: false,
              lineTension: 0,
              backgroundColor: "rgba(0,0,255,1.0)",
              borderColor: "rgba(0,0,255,0.1)",
              data: []
            }]
          },
          options: {
            legend: { display: false },
            title: {
              display: true,
              text: 'Exam Average Marks Over Time'
            },
            scales: {
              xAxes: [{
                type: 'time',
                time: {
                  unit: 'date'
                },
                scaleLabel: {
                  display: true,
                  labelString: 'Exam Date'
                }
              }],
              yAxes: [{
                scaleLabel: {
                  display: true,
                  labelString: 'Average Marks'
                }
              }]
            }
          }
        });

        fetch('../../src/controllers/get_exam_data.php')
            .then(response => response.json())
            .then(data => {
              const labels = data.map(item => item.exam_date);
              const values = data.map(item => item.average_mark);
              myChart.data.labels = labels;
              myChart.data.datasets.forEach((dataset) => {
                dataset.data = values;
              });
              myChart.update();
            })
            .catch(error => console.error('Error:', error));
    }
  }
}
