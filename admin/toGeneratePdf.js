function generatePdf(){
      console.log("gg");
      var toPrint = document.createElement("div");
      var headline = document.createElement("h3");
      headline.append("Received Complaints");
      toPrint.append(headline); 
      var element = document.getElementById('complaint-tbl');
      toPrint.append(element);
      console.log(toPrint);
      var opt = {
            margin:       [1, 1, 0, 0], 
            pageBreak: { mode: 'css', before:'#nextpage1'},
            filename:     'receivedComplaints.pdf',
            html2canvas:  { scale: 2, width: 900, height: 1000 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
          };
      // html2pdf(element, opt);
      html2pdf().from(toPrint).set(opt).save();
      
}