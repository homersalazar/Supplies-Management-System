function print() {
    var divContents = document.getElementById("print").innerHTML;
    var a = window.open('', '', 'height=650, width=900');
    a.document.write('<html>');
    a.document.write('<head> <br> <h3 style="text-align:center;">GLOBAL HEAVY EQUIPMENT AND CONSTRUCTION CORP. <br> <h4 style="text-align:center; text-decoration: underline;">Summary Report <br>');
    a.document.write('<body> <h3 asdas <br><br>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.focus();
    a.print();
    a.close();
    return false;
}