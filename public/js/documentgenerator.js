var json = "";
// Call by AJAX the upload method from UserController and execute read.php script
// The function of read.php script are read the text from user templeate document and extract the plain text
/* $("#view").on("click", function(){
jQuery.ajax({
    type: "POST",
    url: 'read.php',
    dataType: 'json',
    data: {functionname: 'convert', arguments: 'uploads/', _token: "{{csrf_token()}}"},

    success: function (obj, textstatus) {
    if( !('error' in obj) ) {

        // Process the information and split the string by "{}" 
        var text = String(obj.result);
        var words = text.split(" ");
        var variables = [];
        
        // Separate the variables 
        for(var i = 0; i < words.length; i++){
        if(words[i].includes("{") && words[i].includes("}")){
            words[i] = words[i].replace(/(\r\n|\n|\r)/gm, "");
            words[i] = words[i].replace("{", "");
            words[i] = words[i].replace("}", "\n");

            variables.push(words[i]);
        }
        }
        
        // Delete repeat variables
        var uniqueVariables = [];
        $.each(variables, function(i, el){
            if($.inArray(el, uniqueVariables) === -1) uniqueVariables.push(el);
        });
        
        $("#info").html(obj.result) // Send info to html
        $("#var").html(uniqueVariables);
        
        // Show hiden elements on the view
        $("#excel").toggle();
        $("#excelform").toggle();
        //$("#form").hide();
        //$("#view").click();
    }
    else {
        $("#info").html(obj.error);
    }
    }
});
}) */

// Read Fill Excel and convert into JSON objects
/*function excel(excel){
    var urlE = excel;
    var oReq = new XMLHttpRequest();
    oReq.open("GET", urlE, true);
    oReq.responseType = "arraybuffer";

    oReq.onload = function(e) {
        var arraybuffer = oReq.response;

        // Convert data to binary string
        var data = new Uint8Array(arraybuffer);
        var arr = new Array();

        for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
        
        var bstr = arr.join("");

        // Call XLSX
        var workbook = XLSX.read(bstr, {
            type: "binary"
        });
        
        // DO SOMETHING WITH workbook HERE
        var first_sheet_name = workbook.SheetNames[0];
        // Get worksheet
        var worksheet = workbook.Sheets[first_sheet_name];
        // Send JSON object 
        XLSX.utils.sheet_to_json(worksheet, {
            raw: true
        });

        // Copy the JSON object to process it later
        json = XLSX.utils.sheet_to_json(worksheet);
        console.log('dada');
        console.log(json);
    }
    // Finish the process
    oReq.send();

    // Activate another process
    //$("#json").click();
}*/

// Script to generate the documents
var documentName = "output"; // Default value;
var count = 0;

// Copy the variable of the document name
function document_name(name){
//console.log("Antes: " + String(documentName));
//console.log("Nombre: " + String(name));
    if(name.length > 0){
        documentName = String(name);
    }
//console.log("Despues: " + String(documentName));
}

// Load file
function loadFile(url,callback){
    JSZipUtils.getBinaryContent(url,callback);
}

// Generateall the documents
function generate(file) {
//alert("Make sure that your downloads folder is empty!! And then press 'OK'");
    loadFile(file,function(error,content){
    // Process each JSON object and create his own document. 
    // Divide the process each 10 execution to download all the documents and don't saturate the browser
        for(var i = 0; i < 10 && count < json.length; i++){
            if (error) { throw error };
            var zip = new JSZip(content);
            var doc = new window.docxtemplater().loadZip(zip);

            // Set the Json from excel
            doc.setData(json[count]);

            try {
                // render the document (replace all occurences of {first_name} by John, {last_name} by Doe, ...)
                doc.render()
            }
            catch (error) {
                var e = {
                    message: error.message,
                    name: error.name,
                    stack: error.stack,
                    properties: error.properties,
                }
                console.log(JSON.stringify({error: e}));
                // The error thrown here contains additional information when logged with JSON.stringify (it contains a property object).
                throw error;
            }
            
            var out = doc.getZip().generate({
                type:"blob",
                mimeType: "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            }) // Output the document using Data-URI

            // Obtain the first value from the excel list to name the document
            var result = [];
            var obj = json[count];

            // Convert the JSON object to obtain the first value of the first variable
            for(var i in obj)
            result.push([i, obj [i]]);

            // Download the document
            //console.log(count);
            saveAs(out, String(documentName) + "_" + String(result[0][1])+".docx");
            
            count++;
        }

        // Out of the process
        if(count < json.length){
            //console.log("New execution in: " + String(count));
            setTimeout(function(){generate(file)}); // Call again the process if already doesn't finish yet
        }
        else{
            window.location = "/createtemplate";
        }
    })
}

// Script to generate the excel file with the variables from the template
function generateExcel(json){
    /* text = json;
    var variables = text.split(" ");
    variables.pop();
    // Create the JSON object to send into Excel document
    var json = [{}];

    for(var i=0; i < variables.length; i++){
    var newVariable = String(variables[i]);
    var newValue = "";
    json[0][newVariable] = newValue;
    } */
    // Call the method to generate the Excel file by the JSON object
    JSONToCSVConvertor(json, String(json[1]['__EMPTY']), true);
} 

// Generate the CSV file for the user
function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    // If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = 'sep=,' + '\r\n\n';

    // This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        
        // This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            // Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);
        // append Label row with line break
        CSV += row + '\r\n';
    }
    //console.log(arrData);
    // 1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        if(!arrData[i].hasOwnProperty('Project Charter')){
            var row = '" ",';
        }
        else{
            var row = "";
        }
        
        // 2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);
        // add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
    
    // Generate a file name
    var fileName = "ProjectCharter_";
    // this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g,"_");   
    
    // Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;
    
    // set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    // this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

