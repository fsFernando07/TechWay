function handleCredentialResponse(response) {
    const data = jwt_decode(response.credential)
    nomeUsuGoogle.value = data.name
    emailUsuGoogle.value = data.email
    verEmailUsuGoogle.value = data.email_verified
    idUsuGoogle.value = data.sub
    enviarLogGoogle.click()
}

window.onload = function () {
    google.accounts.id.initialize({
        client_id: "927410357817-eetljhlbrs7ikbi7l9fm6vfcg3cbf29l.apps.googleusercontent.com",
        callback: handleCredentialResponse
    });
    google.accounts.id.renderButton(
        document.getElementById("botaoGoogle"),{ 
            theme: "filled_black", 
            size: "large",
            type: "standard",
            shape: "pill",
            text: "continue_with",
            locale: "pt-BR",
            logo_alignment: "left",
        }
    );
    google.accounts.id.prompt();
}


