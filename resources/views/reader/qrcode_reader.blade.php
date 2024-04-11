<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var scanner = null;
    var isScannerVisible = false;

    function initializeScanner() {
        if (scanner != null) {
            scanner.stop();
            scanner = null;
            isScannerVisible = false;
            document.getElementById('divLerQrCode').style = "display: none;"
        } else {
            scanner = new Instascan.Scanner({video: document.getElementById('preview'), mirror: false});
            scanner.addListener('scan', function (content) {
                document.getElementById('slBook').value = content;
                scanner.stop();
                document.getElementById('divLerQrCode').style.display = "none";
            });
            isScannerVisible = true;
            document.getElementById("divLerQrCode").style = "display: block;"
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length == 1) {
                    scanner.start(cameras[0]);
                } else if (cameras.length > 1) {
                    cameras.forEach(selecionarCameraTraseira);
                } else {
                    console.log("Dispositivo não possui câmera.");
                }
            }).catch(function (e) {
                console.error(e);
                alert("Dispositivo não possui câmera.");
                document.getElementById("divLerQrCode").style = "display: block;"
            });
        }
    }

    function selecionarCameraTraseira(element) {
        if (element.name.match(/back/) && !element.name.match(/camera2 3, facing back/)) {
            scanner.start(element);
        }
    }

    document.getElementById("btnShowVideo").addEventListener('click', function () {
        event.preventDefault();
        initializeScanner();
    });
</script>
