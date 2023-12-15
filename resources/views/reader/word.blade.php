<!-- <iframe width="700" height="800" src="https://docs.google.com/gview?url=https://api.nasida.na.gov.ng/downloads/Nasarawa-State-Debt-Sustainability-Analysis-Debt-Management-Strategy-(DSA-DMS)-Report-2023&embedded=true"></iframe> -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <link rel="resource" type="application/l10n" href="locale/locale.properties">
    <script src="{{asset('pdf_js/generic/build/pdf.js')}}"></script>

    <script src="{{asset('pdf_js/js/pdf.js_readonly.js')}}"></script>
    <script src="{{asset('pdf_js/js/viewer_noprint.js')}}"></script>
</head>
<body>
    {{-- <?php echo $doc->url; ?> --}}
    <!-- <input id="files" type="file" /> -->
    {{-- <input type="button" id="btnPreview" value="Preview Word Document" onclick="PreviewWordDoc()" /> --}}
    <div id="word-container" class=""></div>
    <script type="text/javascript" src="https://unpkg.com/jszip/dist/jszip.min.js"></script>
    <script src="{{asset('word/Scripts/docx-preview.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.26.2/docxtemplater.js"></script>
<script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip.js"></script>
<script src="https://unpkg.com/pizzip@3.1.1/dist/pizzip-utils.js"></script>

    <script type="text/javascript">
        document.addEventListener('contextmenu', event => {
            event.preventDefault();
        });
        function loadFile(url, callback) {
            PizZipUtils.getBinaryContent(url, callback);
        }
        function PreviewWordDoc() {
            loadFile(
              '<?php echo $doc->url; ?>',
            //   "http://127.0.0.1:5500/DOCs/sample.docx",
              function (error, content) {
                  if (error) {
                      throw error;
                  }

                //   console.log(content);
                  if (content != null) {
                      //Set the Document options.
                      var docxOptions = Object.assign(docx.defaultOptions, {
                          useMathMLPolyfill: true
                      });
                      //Reference the Container DIV.
                      var container = document.querySelector("#word-container");
                      //Render the Word Document.
                      docx.renderAsync(content, container, null, docxOptions);
                  }
              }
          );
        }

        window.onload = function() {
            PreviewWordDoc();
        };

    </script>
</body>
</html>
