package com.example.programacionweb_its_prac1;

import io.jsonwebtoken.Claims;
import io.jsonwebtoken.JwtParser;
import io.jsonwebtoken.Jwts;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

import java.io.IOException;

import static com.example.programacionweb_its_prac1.AutenticacionServlet.generalKey;

@WebServlet("/user-servlet/*")
public class UserServlet extends HttpServlet {
    private final JsonResponse jResp = new JsonResponse();

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws IOException {
        resp.setContentType("application/json");
        String authTokenHeader = req.getHeader("Authorization");

        if (authTokenHeader == null || !authTokenHeader.startsWith("Bearer ")) {
            jResp.failed(req, resp, "Token faltante o mal formado", HttpServletResponse.SC_UNAUTHORIZED);
            return;
        }

        String token = authTokenHeader.split(" ")[1];
        validateAuthToken(req, resp, token);
    }

    /**
     * Método que se utiliza para validar el token de autenticación. Si el token es válido,
     * se devuelve en un JSON la información del usuario excepto la contraseña.
     * Si el token no es válido, se envía una respuesta fallida.
     * @param req
     * @param resp
     * @param token Token de autenticación
     * @throws IOException
     */
    private void validateAuthToken(HttpServletRequest req, HttpServletResponse resp, String token) throws IOException {
        JwtParser jwtParser = Jwts.parser()
                .verifyWith(generalKey())
                .build();

        try {
            // Analizar el token y obtener el sujeto (username o email)
            Claims claims = jwtParser.parseClaimsJws(token).getBody();
            String username = claims.getSubject(); // El usuario se almacena en "subject"

            // Buscar el usuario en el HashMap
            User user = AutenticacionServlet.users.get(username);

            if (user != null) {
                String userJson = String.format(
                        "{ \"username\": \"%s\", \"fullName\": \"%s\", \"email\": \"%s\" }",
                        user.getUsername(), user.getFullName(), user.getEmail()
                );

                // Responder con los datos del usuario
                jResp.success(req, resp, "Usuario autenticado y datos recuperados", userJson);
            } else {
                jResp.failed(req, resp, "Usuario no encontrado", HttpServletResponse.SC_NOT_FOUND);
            }

        } catch (Exception e) {
            jResp.failed(req, resp, "Token inválido o expirado: " + e.getMessage(), HttpServletResponse.SC_UNAUTHORIZED);
        }
    }
}
