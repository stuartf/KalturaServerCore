<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

	<xsl:param name="KalturaCurrentTimestamp"/>

	<!-- TEMPLATE - Copy source - main template -->
	<xsl:template match="@*|node()">
		<xsl:copy>
			<xsl:if test="local-name()='metadata'">
				<xsl:if test="not(//metadata/LogSunriseSiteFree)">
					<xsl:call-template name="catchLogSunriseSiteFree"/>
				</xsl:if>
			</xsl:if>
			<xsl:apply-templates select="@*|node()"/>
		</xsl:copy>		
	</xsl:template>
	
	<!-- TEMPLATE - Catch LogSunriseSiteFree -->
	<xsl:template name="catchLogSunriseSiteFree" match="//metadata/LogSunriseSiteFree">
		<xsl:element name="LogSunriseSiteFree">
			<xsl:call-template name="modifyHistory">
				<xsl:with-param name="currentHistory" select="//metadata/LogSunriseSiteFree"/>
				<xsl:with-param name="adField" select="//metadata/SunriseSiteFree" />
				<xsl:with-param name="edField" select="//metadata/SunsetSiteFree" />
			</xsl:call-template>
		</xsl:element>
		<xsl:if test="not(//metadata/LogSunriseSitePaid)">
			<xsl:call-template name="catchLogSunriseSitePaid"/>
		</xsl:if>
	</xsl:template>
	
	<!-- TEMPLATE - Catch LogSunriseSitePaid -->
	<xsl:template name="catchLogSunriseSitePaid" match="//metadata/LogSunriseSitePaid">
		<xsl:element name="LogSunriseSitePaid">
			<xsl:call-template name="modifyHistory">
				<xsl:with-param name="currentHistory" select="//metadata/LogSunriseSitePaid"/>
				<xsl:with-param name="adField" select="//metadata/SunriseSitePaid" />
				<xsl:with-param name="edField" select="//metadata/SunsetSitePaid" />
			</xsl:call-template>
		</xsl:element>
		<xsl:if test="not(//metadata/LogSunriseTabletFree)">
			<xsl:call-template name="catchLogSunriseTabletFree"/>
		</xsl:if>
	</xsl:template>
	
	<!-- TEMPLATE - Catch LogSunriseTabletFree -->
	<xsl:template name="catchLogSunriseTabletFree" match="//metadata/LogSunriseTabletFree">
		<xsl:element name="LogSunriseTabletFree">
			<xsl:call-template name="modifyHistory">
				<xsl:with-param name="currentHistory" select="//metadata/LogSunriseTabletFree"/>
				<xsl:with-param name="adField" select="//metadata/SunriseTabletFree" />
				<xsl:with-param name="edField" select="//metadata/SunsetTabletFree" />
			</xsl:call-template>
		</xsl:element>
		<xsl:if test="not(//metadata/LogSunriseTabletPaid)">
			<xsl:call-template name="catchLogSunriseTabletPaid"/>
		</xsl:if>
	</xsl:template>
	
	<!-- TEMPLATE - Catch LogSunriseTabletPaid -->
	<xsl:template name="catchLogSunriseTabletPaid" match="//metadata/LogSunriseTabletPaid">
		<xsl:element name="LogSunriseTabletPaid">
			<xsl:call-template name="modifyHistory">
				<xsl:with-param name="currentHistory" select="//metadata/LogSunriseTabletPaid"/>
				<xsl:with-param name="adField" select="//metadata/SunriseTabletPaid" />
				<xsl:with-param name="edField" select="//metadata/SunsetTabletPaid" />
			</xsl:call-template>
		</xsl:element>
		<xsl:if test="not(//metadata/LogSunriseCellFree)">
			<xsl:call-template name="catchLogSunriseCellFree"/>
		</xsl:if>
	</xsl:template>
	
	<!-- TEMPLATE - Catch LogSunriseCellFree -->
	<xsl:template name="catchLogSunriseCellFree" match="//metadata/LogSunriseCellFree">
		<xsl:element name="LogSunriseCellFree">
			<xsl:call-template name="modifyHistory">
				<xsl:with-param name="currentHistory" select="//metadata/LogSunriseCellFree"/>
				<xsl:with-param name="adField" select="//metadata/SunriseCellFree" />
				<xsl:with-param name="edField" select="//metadata/SunsetCellFree" />
			</xsl:call-template>
		</xsl:element>
		<xsl:if test="not(//metadata/LogSunriseCellPaid)">
			<xsl:call-template name="catchLogSunriseCellPaid"/>
		</xsl:if>
	</xsl:template>
	
	<!-- TEMPLATE - Catch LogSunriseCellPaid -->
	<xsl:template name="catchLogSunriseCellPaid" match="//metadata/LogSunriseCellPaid">
		<xsl:element name="LogSunriseCellPaid">
			<xsl:call-template name="modifyHistory">
				<xsl:with-param name="currentHistory" select="//metadata/LogSunriseCellPaid"/>
				<xsl:with-param name="adField" select="//metadata/SunriseCellPaid" />
				<xsl:with-param name="edField" select="//metadata/SunsetCellPaid" />
			</xsl:call-template>
		</xsl:element>
	</xsl:template>
		
	
	<!-- TEMPLATE - Modify history -->
	<xsl:template name="modifyHistory">
		<xsl:param name="currentHistory"/>
		<xsl:param name="adField"/>
		<xsl:param name="edField"/>
		<xsl:variable name="newAdValue"><xsl:value-of select="$adField"/></xsl:variable>
		<xsl:variable name="newEdValue"><xsl:value-of select="$edField"/></xsl:variable>
		<xsl:variable name="currentHistoryValue"><xsl:value-of select="$currentHistory"/></xsl:variable>
		
		<!-- Get last ad/ed values -->
		<xsl:variable name="lastHistoryDatesTemp">
			<xsl:call-template name="getLastSubString">
				<xsl:with-param name="pSeperator" select="'{'"/>
				<xsl:with-param name="pText" select="$currentHistoryValue"/>
			</xsl:call-template>			
		</xsl:variable>
		
		<xsl:variable name="lastAdValue">
			<xsl:variable name="lastAdValueTemp"><xsl:value-of select="substring-after($lastHistoryDatesTemp,'&quot;ad&quot;:&quot;')" /></xsl:variable>
			<xsl:value-of select="substring-before($lastAdValueTemp,'&quot;,')" />
		</xsl:variable>
		
		<xsl:variable name="lastEdValue">
			<xsl:variable name="lastEdValueTemp"><xsl:value-of select="substring-after($lastHistoryDatesTemp,'&quot;ed&quot;:&quot;')" /></xsl:variable>
			<xsl:value-of select="substring-before($lastEdValueTemp,'&quot;}')" />			
		</xsl:variable>
			
		<!-- Decide what to do -->
		<xsl:choose>
		
			<!-- Date fields are empty - just copy history -->
			<xsl:when test="$newAdValue = '' or $newEdValue = ''">
				<xsl:value-of select="$currentHistoryValue"/>
			</xsl:when>
			
			<!-- New sunset <= New sunrise - invalid values - just copy history -->
			<xsl:when test="$newAdValue &gt;= $newEdValue">
				<xsl:value-of select="$currentHistoryValue"/>
			</xsl:when>
								
			
			<!-- History was empty till now -->
			<xsl:when test="$currentHistoryValue = ''">
			
				<xsl:choose>
				
					<!-- New sunrise is in the future - add the new fields -->
					<xsl:when test="$newAdValue &gt; $KalturaCurrentTimestamp">
						<xsl:variable name="newHistoryTemp">
							<xsl:call-template name="getAdEdString">
								<xsl:with-param name="adValue" select="$newAdValue"/>
								<xsl:with-param name="edValue" select="$newEdValue"/>
							</xsl:call-template>
						</xsl:variable>
						<xsl:value-of select="concat(concat('[',normalize-space($newHistoryTemp)),']')"/>
					</xsl:when>	
				
					<!-- New sunrise is in the past, New sunset is in the future - Change sunrise to KalturaCurrentTimestamp -->
					<xsl:when test="$newAdValue &lt;= $KalturaCurrentTimestamp and $newEdValue &gt; $KalturaCurrentTimestamp">
						<xsl:variable name="newHistoryTemp">
							<xsl:call-template name="getAdEdString">
								<xsl:with-param name="adValue" select="$KalturaCurrentTimestamp"/>
								<xsl:with-param name="edValue" select="$newEdValue"/>
							</xsl:call-template>
						</xsl:variable>
						<xsl:value-of select="concat(concat('[',normalize-space($newHistoryTemp)),']')"/>
					</xsl:when>
					
					<!-- Both new values are in the past - Do not add values to history - just copy history -->
					<xsl:when test="$newAdValue &lt;= $KalturaCurrentTimestamp and $newEdValue &lt;= $KalturaCurrentTimestamp">
						<xsl:value-of select="$currentHistoryValue"/>
					</xsl:when>
									
					<!-- Should never happen - copying history just in case -->
					<xsl:otherwise>
						<xsl:value-of select="$currentHistoryValue"/>
					</xsl:otherwise>
				
				</xsl:choose>
				
			</xsl:when>
			
			<!-- Date values weren't changed from last time - just copy history -->
			<xsl:when test="$newAdValue = $lastAdValue and $newEdValue = $lastEdValue">
				<xsl:value-of select="$currentHistoryValue"/>
			</xsl:when>
			
			
			
			<!-- Last sunrise/sunset dates already passed -->
			<xsl:when test="$lastEdValue &lt; $KalturaCurrentTimestamp">
			
				<xsl:choose>
				
					<!-- New sunrise/sunset dates are also in the past - Do not add values to history - just copy history -->
					<xsl:when test="$newEdValue &lt;= $KalturaCurrentTimestamp">
						<xsl:value-of select="$currentHistoryValue"/>
					</xsl:when>
					
					<!-- New sunrise/sunset dates are in the future - add the new values -->
					<xsl:when test="$newAdValue &gt;= $KalturaCurrentTimestamp">
						<xsl:call-template name="addNewFieldsToHistory">
							<xsl:with-param name="newAdValue" select="$newAdValue"/>
							<xsl:with-param name="newEdValue" select="$newEdValue"/>
							<xsl:with-param name="currentHistoryValue" select="$currentHistoryValue"/>
						</xsl:call-template>
					</xsl:when>
					
					<!-- Entry is going live now - add the new fields but change the new sunrise to now -->
					<xsl:otherwise>					
						<xsl:call-template name="addNewFieldsToHistory">
							<xsl:with-param name="newAdValue" select="$KalturaCurrentTimestamp"/>
							<xsl:with-param name="newEdValue" select="$newEdValue"/>
							<xsl:with-param name="currentHistoryValue" select="$currentHistoryValue"/>
						</xsl:call-template>
					</xsl:otherwise>
				
				</xsl:choose>
					
			</xsl:when>
			
			
			<!-- Last sunrise/sunset dates didn't arrive yet -->
			<xsl:when test="$lastAdValue &gt; $KalturaCurrentTimestamp">
				
				<xsl:choose>
				
					<!-- New sunrise/sunset dates are in the past - Do not add values to history - just copy history -->
					<xsl:when test="$newEdValue &lt;= $KalturaCurrentTimestamp">
						<xsl:value-of select="$currentHistoryValue"/>
					</xsl:when>
					
					<!-- New sunrise/sunset dates are in the future - replace old values with new -->
					<xsl:when test="$newAdValue &gt;= $KalturaCurrentTimestamp">
						<xsl:call-template name="replaceOldWithNew">
							<xsl:with-param name="historyString" select="$currentHistoryValue"/>
							<xsl:with-param name="lastAdValue" select="$lastAdValue"/>
							<xsl:with-param name="lastEdValue" select="$lastEdValue"/>
							<xsl:with-param name="newAdValue" select="$newAdValue"/>
							<xsl:with-param name="newEdValue" select="$newEdValue"/>
						</xsl:call-template>
					</xsl:when>
					
					<!-- Entry is going live now - replace old dates with new ones but change new sunrise to now -->
					<xsl:otherwise>					
						<xsl:call-template name="replaceOldWithNew">
							<xsl:with-param name="historyString" select="$currentHistoryValue"/>
							<xsl:with-param name="lastAdValue" select="$lastAdValue"/>
							<xsl:with-param name="lastEdValue" select="$lastEdValue"/>
							<xsl:with-param name="newAdValue" select="$KalturaCurrentTimestamp"/>
							<xsl:with-param name="newEdValue" select="$newEdValue"/>
						</xsl:call-template>
					</xsl:otherwise>
				
				</xsl:choose>
				
			</xsl:when>
			
			
			<!-- Entry is currently live according to the last dates -->
			<xsl:when test="$lastAdValue &lt; $KalturaCurrentTimestamp and $lastEdValue &gt; $KalturaCurrentTimestamp">
				
				<xsl:choose>
				
					<!-- New sunrise/sunset dates are in the past - replace old sunset with now -->
					<xsl:when test="$newEdValue &lt;= $KalturaCurrentTimestamp">
						<xsl:call-template name="replaceOldWithNew">
							<xsl:with-param name="historyString" select="$currentHistoryValue"/>
							<xsl:with-param name="lastAdValue" select="$lastAdValue"/>
							<xsl:with-param name="lastEdValue" select="$lastEdValue"/>
							<xsl:with-param name="newAdValue" select="$lastAdValue"/>
							<xsl:with-param name="newEdValue" select="$KalturaCurrentTimestamp"/>
						</xsl:call-template>					
					</xsl:when>
					
					<!-- Now is between the new dates - replace the old sunset with the new sunset -->
					<xsl:when test="$newAdValue &lt;= $KalturaCurrentTimestamp">
						<xsl:call-template name="replaceOldWithNew">
							<xsl:with-param name="historyString" select="$currentHistoryValue"/>
							<xsl:with-param name="lastAdValue" select="$lastAdValue"/>
							<xsl:with-param name="lastEdValue" select="$lastEdValue"/>
							<xsl:with-param name="newAdValue" select="$lastAdValue"/>
							<xsl:with-param name="newEdValue" select="$newEdValue"/>
						</xsl:call-template>
					</xsl:when>
					
					<!-- New dates are in the future - change old sunset to now and add the new dates -->
					<xsl:otherwise>					
						<xsl:variable name="newHistoryTemp">
							<xsl:call-template name="replaceOldWithNew">
								<xsl:with-param name="historyString" select="$currentHistoryValue"/>
								<xsl:with-param name="lastAdValue" select="$lastAdValue"/>
								<xsl:with-param name="lastEdValue" select="$lastEdValue"/>
								<xsl:with-param name="newAdValue" select="$lastAdValue"/>
								<xsl:with-param name="newEdValue" select="$KalturaCurrentTimestamp"/>
							</xsl:call-template>
						</xsl:variable>				
						<xsl:call-template name="addNewFieldsToHistory">
							<xsl:with-param name="newAdValue" select="$newAdValue"/>
							<xsl:with-param name="newEdValue" select="$newEdValue"/>
							<xsl:with-param name="currentHistoryValue" select="$newHistoryTemp"/>
						</xsl:call-template>
					</xsl:otherwise>

				</xsl:choose>
				
			</xsl:when>
			
			<!-- Should never happen - copying history just in case -->
			<xsl:otherwise>
				<xsl:value-of select="$currentHistoryValue"/>
			</xsl:otherwise>
		
		</xsl:choose>
		
	</xsl:template>
	
	<!-- TEMPLATE - Replace string -->
	<xsl:template name="string-replace-all">
		<xsl:param name="text" />
		<xsl:param name="replace" />
		<xsl:param name="by" />
		<xsl:choose>
			<xsl:when test="contains($text, $replace)">
				<xsl:value-of select="substring-before($text,$replace)" />
				<xsl:value-of select="$by" />
				<xsl:call-template name="string-replace-all">
					<xsl:with-param name="text" select="substring-after($text,$replace)" />
					<xsl:with-param name="replace" select="$replace" />
					<xsl:with-param name="by" select="$by" />
				</xsl:call-template>
			</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$text" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	
	<!-- TEMPLATE - Get last substring -->
	<xsl:template name="getLastSubString">
		<xsl:param name="pText"/>
		<xsl:param name="pSeperator"/>
		<xsl:choose>
			<xsl:when test="not(contains($pText,$pSeperator))">
				<xsl:value-of select="$pText"/>
			</xsl:when>
			<xsl:otherwise>
				<xsl:call-template name="getLastSubString">
					<xsl:with-param name="pSeperator" select="$pSeperator"/>
					<xsl:with-param name="pText" select="substring-after($pText, $pSeperator)"/>
				</xsl:call-template>
			</xsl:otherwise>
		</xsl:choose>
    </xsl:template>
	
	<!-- TEMPLATE - Get ad/ed string -->
	<xsl:template name="getAdEdString">
		<xsl:param name="adValue"/>
		<xsl:param name="edValue"/>
		{"ad":"<xsl:value-of select="$adValue"/>","ed":"<xsl:value-of select="$edValue"/>"}
    </xsl:template>
	
	
	<!-- TEMPLATE - Replace old with new history -->
	<xsl:template name="replaceOldWithNew">
		<xsl:param name="historyString"/>
		<xsl:param name="lastAdValue"/>
		<xsl:param name="lastEdValue"/>
		<xsl:param name="newAdValue"/>
		<xsl:param name="newEdValue"/>
	
		<xsl:variable name="oldHistoryTemp">
			<xsl:call-template name="getAdEdString">
				<xsl:with-param name="adValue" select="$lastAdValue"/>
				<xsl:with-param name="edValue" select="$lastEdValue"/>
			</xsl:call-template>
		</xsl:variable>				
		<xsl:variable name="newHistoryTemp">
			<xsl:call-template name="getAdEdString">
				<xsl:with-param name="adValue" select="$newAdValue"/>
				<xsl:with-param name="edValue" select="$newEdValue"/>
			</xsl:call-template>
		</xsl:variable>
		
		<xsl:call-template name="string-replace-all">
			<xsl:with-param name="text" select="$historyString" />
			<xsl:with-param name="replace" select="concat(normalize-space($oldHistoryTemp),']')" />
			<xsl:with-param name="by" select="concat(normalize-space($newHistoryTemp),']')" />
		</xsl:call-template>
	</xsl:template>
	
	
	<xsl:template name="addNewFieldsToHistory">
		<xsl:param name="newAdValue"/>
		<xsl:param name="newEdValue"/>
		<xsl:param name="currentHistoryValue"/>	
		<xsl:variable name="newHistoryTemp">
			<xsl:call-template name="getAdEdString">
				<xsl:with-param name="adValue" select="$newAdValue"/>
				<xsl:with-param name="edValue" select="$newEdValue"/>
			</xsl:call-template>
		</xsl:variable>
		<xsl:call-template name="string-replace-all">
			<xsl:with-param name="text" select="$currentHistoryValue" />
			<xsl:with-param name="replace" select="'}]'" />
			<xsl:with-param name="by" select="concat(concat('},',normalize-space($newHistoryTemp)),']')" />
		</xsl:call-template>
	</xsl:template>
	
</xsl:stylesheet>