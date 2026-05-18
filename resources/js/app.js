import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    const otpInputs = document.querySelectorAll(".otp-box .otp");

    otpInputs.forEach((input, index) => {
        input.addEventListener("input", (e) => {
            input.value = input.value.replace(/[^0-9]/g, "");

            if (input.value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && !input.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });
});
