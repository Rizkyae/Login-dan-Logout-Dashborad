document.addEventListener("DOMContentLoaded", function () {
  const passwordInput = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");

  if (!passwordInput || !togglePassword) {
    return;
  }

  const eyeOpen = `
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <path d="M1.5 12S5 5 12 5s10.5 7 10.5 7-3.5 7-10.5 7S1.5 12 1.5 12Z"/>
      <circle cx="12" cy="12" r="3.2"/>
    </svg>`;

  const eyeClosed = `
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
      <path d="M3 3l18 18"/>
      <path d="M10.6 5.2A10.6 10.6 0 0 1 12 5c7 0 10.5 7 10.5 7a13.6 13.6 0 0 1-3.1 3.9M6.6 6.6C3.6 8.4 1.5 12 1.5 12s3.5 7 10.5 7a10.4 10.4 0 0 0 4.4-.9"/>
      <path d="M9.5 9.9a3.2 3.2 0 0 0 4.6 4.5"/>
    </svg>`;

  togglePassword.innerHTML = eyeOpen;

  togglePassword.addEventListener("click", function () {
    const isHidden = passwordInput.type === "password";
    passwordInput.type = isHidden ? "text" : "password";
    togglePassword.innerHTML = isHidden ? eyeClosed : eyeOpen;
    togglePassword.setAttribute(
      "aria-label",
      isHidden ? "Sembunyikan password" : "Tampilkan password"
    );
  });
});
