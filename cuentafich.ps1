# Define la función para contar los archivos por extensión
function Contar-FicherosPorExtension {
    param (
        [string]$Directorio,
        [string[]]$Extensiones
    )

    $total = 0
    Get-ChildItem -Path $Directorio -Recurse | ForEach-Object {
        if ($_ -is [System.IO.FileInfo]) {
            if ($Extensiones -contains $_.Extension.TrimStart('.')) {
                $total++
                Write-Host "Fichero encontrado: $($_.FullName)"
            }
        }
        elseif ($_ -is [System.IO.DirectoryInfo]) {
            Write-Host "Buscando en la carpeta: $($_.FullName)"
        }
    }
    return $total
}

# Obtener la ruta del directorio como argumento de línea de comandos
param (
    [Parameter(Mandatory=$true, Position=0)]
    [string]$Directorio,
    [string[]]$Extensiones = @("php", "js", "css", "html")
)

# Convertir la ruta del directorio a una ruta absoluta si es relativa
if (-not (Test-Path $Directorio)) {
    $Directorio = Join-Path $pwd.Path $Directorio
}

# Llama a la función para contar los archivos
$total_ficheros = Contar-FicherosPorExtension -Directorio $Directorio -Extensiones $Extensiones

# Imprime el resultado
Write-Host "Total de ficheros con extensiones $($extensiones -join ', '): $total_ficheros"
