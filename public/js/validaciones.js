function validarCampo(campo, tipo, longitud) {
    var valor = campo.value.trim();
    // obtener el name del campo
    var name = campo.hasAttribute("name") ? campo.getAttribute("name") : "";

    // Validar que el campo no esté vacío
    // if (valor === "" ) {
    //     alert("El campo " + name + " no puede estar vacío");
    //     return false;
    // }

    // Validar si el campo es obligatorio
    if (campo.hasAttribute("required") && !valor) {
        alert("El campo " + name + " es obligatorio");
        return false;
    }

    // Validar según el tipo de campo
    if (tipo === "email") {
        var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!valor.match(emailRegex)) {
            alert("El campo " + name + " debe ser una dirección de correo electrónico válida");
            return false;
        }
    } else if (tipo === "string") {
        if (longitud && valor.length < longitud) {
            alert("El campor " + name + " debe tener como minimo " + longitud + " caracteres");
            return false;
        }
    } else if (tipo === "number") {
        if (isNaN(valor)) {
            alert("El campoo " + name + " debe ser un número válido");
            return false;
        }
    } else if (tipo === "date") {
        var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
        if (!valor.match(dateRegex)) {
            alert("El campoo " + name + " debe ser una fecha válida(YYYY-MM-DD)");
            return false;
        }
    }

    // Todas las validaciones pasaron, el campo es válido
    return true;
}
