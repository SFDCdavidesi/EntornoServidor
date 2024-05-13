# Configura la salida de la consola a UTF-8
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8

# Define una función para contar las líneas de código en archivos PHP y JS
function Contar-LineasCodigo {
    param (
        [string]$Directorio
    )

    $total_lineas = 0
    $total_php = 0
    $total_html = 0
    $total_js = 0

    # Obtiene todos los archivos PHP, HTML, JS y CSS en el directorio y sus subdirectorios, excluyendo los archivos dentro de las carpetas "vendor" y "plugins" y sus subcarpetas
    $archivos = Get-ChildItem -Path $Directorio -Recurse -Include *.php,*.html,*.js | Where-Object { !$_.PSIsContainer -and $_.FullName -notmatch "\\vendor\\" -and $_.FullName -notmatch "\\plugins\\" }

    # Itera sobre cada archivo
    foreach ($archivo in $archivos) {
        # Cuenta las líneas de código
        $lineas = Get-Content $archivo.FullName | Measure-Object -Line
        $total_lineas += $lineas.Lines

        # Incrementa el contador de archivos según su extensión
        switch -Wildcard ($archivo.Extension) {
            ".php" { $total_php++ }
            ".html" { $total_html++ }
            ".js" { $total_js++ }
        }
    }

    # Imprime los totales
    Write-Host "Total de líneas de código en archivos PHP, HTML y JS : $total_lineas"
    Write-Host "Total de archivos PHP: $total_php"
    Write-Host "Total de archivos HTML: $total_html"
    Write-Host "Total de archivos JS: $total_js"

    # Muestra un listado de todos los archivos PHP ordenados por tamaño descendente
    Write-Host "Listado de archivos PHP ordenados por tamaño descendente:"
    Get-ChildItem -Path $Directorio -Recurse -Include *.php | Where-Object { !$_.PSIsContainer -and $_.FullName -notmatch "\\vendor\\" -and $_.FullName -notmatch "\\plugins\\" } | Sort-Object Length -Descending | ForEach-Object {
        Write-Host "  $_.Name - Tamaño: $($_.Length) bytes"
    }
}

# Obtén la ruta del directorio como argumento de línea de comandos
param (
    [Parameter(Mandatory=$true, Position=0)]
    [string]$Directorio
)

# Llama a la función para contar las líneas de código
Contar-LineasCodigo -Directorio $Directorio
