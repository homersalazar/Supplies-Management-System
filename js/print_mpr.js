function print_mpr() {
    var divContents = document.getElementById("print_mpr").innerHTML;
    var a = window.open('', '', 'height=650, width=900');
    a.document.write('<html>');
    a.document.write('<head>');
    // Include the CSS styles from the original page
    a.document.write('<style>' + window.document.getElementsByTagName('style')[0].innerHTML + '</style>');
    a.document.write('</head>');
    a.document.write('<body> <h2 style="text-align:center;">GLOBAL HEAVY EQUIPMENT AND CONSTRUCTION CORP.</h2> <h3 style="text-align:center;">MATERIALS/PARTS REQUEST FORM</h3> <br>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.focus();
    a.print();
    a.close();
    return false;
}
