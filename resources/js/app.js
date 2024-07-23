import "./bootstrap";
import { Html5QrcodeScanner } from "html5-qrcode";

document.addEventListener("DOMContentLoaded", function () {
    function onScanSuccess(qrCodeMessage) {
        // Use Axios to send a POST request
        axios
            .post(`/pegawai/absen/${qrCodeMessage}`, {
                // Use template literals to include the token
                // You might not need to send qrCodeMessage in the body if it's already in the URL
            })
            .then(function (response) {
                console.log(response.data);
                // Handle success, e.g., redirect or display a message
                window.location.href = "/pegawai";
            })
            .catch(function (error) {
                console.error("Error:", error);
                // Handle error
                alert("Error: " + error.response.data.message);
                window.location.href = "/pegawai";
            });
    }

    function onScanError(errorMessage) {
        // Handle scan error
        console.error(errorMessage);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 1,
        qrbox: 250,
    });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
});
