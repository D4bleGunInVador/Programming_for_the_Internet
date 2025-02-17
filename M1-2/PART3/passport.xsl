<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <!-- Включення XML декларації -->
    <xsl:output method="html" encoding="UTF-8" doctype-system="passport.dtd" doctype-public=""/>

    <xsl:template match="/">
        <html>
            <head>
                <title>Паспорт</title>
                <link rel="stylesheet" type="text/css" href="passport.css"/>
            </head>
            <body>
                <passport>
                    <header>
                        <xsl:value-of select="passport/header"/>
                    </header>
                    <photo style="background-image: url('{passport/photo}');">
                    </photo>
                    <details>
                        <first_name>Ім'я: <xsl:value-of select="passport/details/first_name"/></first_name>
                        <last_name>Прізвище: <xsl:value-of select="passport/details/last_name"/></last_name>
                        <middle_name>По батькові: <xsl:value-of select="passport/details/middle_name"/></middle_name>
                        <address>Адреса: <xsl:value-of select="passport/details/address"/></address>
                        <id_number>Ідентифікаційний номер: <xsl:value-of select="passport/details/id_number"/></id_number>
                    </details>
                    <footer>
                        <xsl:value-of select="passport/footer"/>
                    </footer>
                </passport>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
