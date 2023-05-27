<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:param name="userRole" />
    <xsl:template match="/">
        <html>
            <head>
                <title>QCM</title>
                <link rel="stylesheet" type="text/css" href="assets/css/pCo.css" />
                <link id="theme-style" rel="stylesheet" type="text/css" href="assets/css/indexNuit.css"/>
                <style>
                    * {
                        color: black;
                    }
                    h1 {
                      color: #FF9800;
                    }
                </style>
            </head>
            <body>
              <header>
                <nav>
                    <ul>
                        <li><a id="modeNuit" href="#">Mode Nuit</a></li>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="index.php?controller=Forum">Forum</a></li>
                        <xsl:if test="$userRole = 'admin'">
                          <li><a href="index.php?controller=Utilisateurs">Utilisateurs</a></li>
                        </xsl:if>
                        <li><a href="index.php?controller=Authentification&amp;action=logout">Déconnexion</a></li>
                    </ul>
                </nav>
            </header>
            <main>
                <h1>QCM</h1>
                <form method="post" action="">
                    <xsl:apply-templates select="//question" />
                    <input type="submit" value="Soumettre" />
                </form>
            </main>
              <script type="text/javascript" src="assets/js/modeNuit.js"></script>
            
            </body>
        </html>

    </xsl:template>

    <xsl:template match="question">
        <div class="question">
            <h2>
                <xsl:value-of select="titre" />
            </h2>
            <xsl:for-each select="choix/*">
                <div class="radio-option">
                    <input type="radio" name="question{../../@id}" id="question_{../../@id}_option_{name()}" value="{name()}" required="required" />
                    <label for="question_{../../@id}_option_{name()}">
                        <xsl:value-of select="." />
                    </label>
                </div>
            </xsl:for-each>
        </div>
    </xsl:template>
</xsl:stylesheet>
