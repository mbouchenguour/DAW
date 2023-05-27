<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <?xml-stylesheet type="text/xsl" href="../qcm.xsl"?>
    <xsl:template match="/">
        <html>
            <head>
                <title>QCM première connexion</title>
                <link rel="stylesheet" type="text/css" href="assets/css/pCo.css" />
            </head>
            <body>
                <h1>QCM</h1>
                <form method="post" action="">
                    <xsl:apply-templates select="//question" />
                    <input type="submit" value="Soumettre" />
                </form>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="question">
        <div class="question">
            <h2>
                <xsl:value-of select="titre" />
            </h2>
            <div class="radio-option">
                <input type="radio" name="{@id}" id="cours_{@id}_yes" value="1" required="required" />
                <label for="cours_{@id}_yes">
                    <xsl:value-of select="choix/oui" />
                </label>
            </div>
            <div class="radio-option">
                <input type="radio" name="{@id}" id="cours_{@id}_no" value="0" required="required" />
                <label for="cours_{@id}_no">
                    <xsl:value-of select="choix/non" />
                </label>
            </div>
        </div>
    </xsl:template>
</xsl:stylesheet>
