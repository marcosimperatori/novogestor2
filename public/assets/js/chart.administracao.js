function carregarGraficos() {
  chartCertificadoDigital();
  chartFuncionarioDepto();
  chartRegimeTributario();
}

function chartCertificadoDigital() {
  google.charts.load("current", {
    packages: ["corechart"],
  });
  google.charts.setOnLoadCallback(function () {
    let jsonData = $.ajax({
      url: "/resumocertificados",
      dataType: "json",
      async: false,
    }).responseJSON;

    let data = google.visualization.arrayToDataTable([
      ["Status", "Quantidade"],
      ["Certificados vigentes", parseInt(jsonData.ativos)],
      ["Certificados vencidos", parseInt(jsonData.inativos)],
      ["Sem Certificado", parseInt(jsonData.sem_cert)],
    ]);

    let options = {
      title: "Situação dos certificados",
      is3D: true,
      legend: {
        position: "right",
        // alignment: 'end'
      },
      pieSliceText: "value",
      pieSliceTextStyle: {
        color: "black", // Definindo a cor da fonte das fatias como branca
      },
      colors: [
        "#CCE0FF",
        "#99C2FF",
        "#66A3FF",
        "#3385FF",
        "#0066FF",
        "#0055E6",
        "#0044CC",
        "#003399",
        "#002266",
        "#001133",
      ],
      chartArea: {
        width: "80%",
        height: "80%",
      },
    };

    let chart = new google.visualization.PieChart(
      document.getElementById("chart_certificados")
    );
    chart.draw(data, options);
  });
}

function chartFuncionarioDepto() {
  google.charts.load("current", {
    packages: ["corechart"],
  });
  google.charts.setOnLoadCallback(function () {
    $.ajax({
      url: "/resumofuncionariosdepto",
      dataType: "json",
      success: function (jsonData) {
        let data = new google.visualization.DataTable();
        data.addColumn("string", "Departamento");
        data.addColumn("number", "Total funcionários");

        console.log(jsonData);

        // Itera sobre os dados retornados do servidor e adiciona cada departamento e total de funcionários como uma linha na tabela de dados
        for (let i = 0; i < jsonData.length; i++) {
          data.addRow([jsonData[i][0], parseInt(jsonData[i][1])]);
        }

        let options = {
          title: "Funcionários por departamento",
          is3D: true,
          legend: {
            position: "right",
          },
          pieSliceText: "value",
          pieSliceTextStyle: {
            color: "black", // Definindo a cor da fonte das fatias como branca
          },
          colors: ["#8AB5FF"],
          chartArea: {
            width: "40%",
            height: "80%",
          },
          hAxis: {
            title: "Quantidade",
          },
          vAxis: {
            title: "Departamentos",
          },
          series: {
            0: {
              // Série 0 corresponde às barras
              bar: { groupWidth: "100%" }, // Coloca as barras coladas umas nas outras
            },
          },
        };

        let chart = new google.visualization.BarChart(
          document.getElementById("chart_funcdepto")
        );
        chart.draw(data, options);
      },
    });
  });
}

function chartRegimeTributario() {
  google.charts.load("current", {
    packages: ["corechart"],
  });
  google.charts.setOnLoadCallback(function () {
    let jsonData = $.ajax({
      url: "/chamar-endpoint",
      dataType: "json",
      async: false,
    }).responseText;

    let jsonDataTeste = [
      ["Regime", "Quantidade"],
      ["Simples Nacional", 176],
      ["Lucro Real", 28],
      ["Lucro Presumido", 33],
      ["Imune", 53],
      ["Isenta", 25],
      ["Outros", 45],
    ];

    let data = new google.visualization.arrayToDataTable(jsonDataTeste);

    let options = {
      title: "Clientes por regime tributário",
      is3D: true,
      legend: {
        position: "right",
        // alignment: 'end'
      },
      pieSliceText: "value",
      pieSliceTextStyle: {
        color: "black", // Definindo a cor da fonte das fatias como branca
      },
      colors: ["#8AB5FF"],
      chartArea: {
        width: "70%",
        height: "70%",
      },

      hAxis: {
        title: "Regimes tributários",
        slantedText: false, // Define as legendas na horizontal
        textStyle: {
          fontSize: 12, // Ajuste o tamanho da fonte se necessário
        },
      },
      vAxis: {
        title: "Quantidade",
      },
      series: {
        0: {
          // Série 0 corresponde às barras
          bar: { groupWidth: "100%" }, // Coloca as barras coladas umas nas outras
        },
      },
    };

    let chart2 = new google.visualization.ColumnChart(
      document.getElementById("chart_tipo2")
    );
    chart2.draw(data, options);
  });
}
