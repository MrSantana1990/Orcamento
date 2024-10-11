import sys
import json
from reportlab.pdfgen import canvas

def gerar_orcamento(cliente, areas, valor_metro_quadrado, logo_path, pdf_path):
    # Decodificar o JSON das áreas
    try:
        areas = json.loads(areas)
    except json.JSONDecodeError as e:
        print(f"Erro ao decodificar JSON: {str(e)}")
        return ""

    # Geração do PDF
    try:
        c = canvas.Canvas(pdf_path)
        c.drawString(100, 750, f"Cliente: {cliente}")
        c.drawString(100, 730, f"Valor por Metro Quadrado: R$ {valor_metro_quadrado:.2f}")
        c.drawString(100, 710, f"Logo: {logo_path}")
        c.drawString(100, 690, "Áreas:")

        y_position = 670
        for area in areas:
            nome = area['nome']
            altura = area['altura']
            largura = area['largura']
            c.drawString(120, y_position, f"{nome}: {altura}m x {largura}m")
            y_position -= 20

        c.save()
        return pdf_path

    except Exception as e:
        print(f"Erro ao gerar o PDF do orçamento: {str(e)}")
        return ""

if __name__ == "__main__":
    if len(sys.argv) < 6:
        print("Uso: python gerar_orcamento.py <cliente> <areas_json> <valor_metro_quadrado> <logo_path> <pdf_path>")
        sys.exit(1)

    cliente = sys.argv[1]
    areas = sys.argv[2]
    valor_metro_quadrado = float(sys.argv[3])
    logo_path = sys.argv[4]
    pdf_path = sys.argv[5]

    pdf_gerado = gerar_orcamento(cliente, areas, valor_metro_quadrado, logo_path, pdf_path)
    print(pdf_gerado)
