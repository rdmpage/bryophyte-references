# Bryophyte References

File of TROPICOS data `bryophytes_taxon_source.tsv`.

Note that the page range separation character is inconsistent, may be hyphen, may be dash.

Export is tab-delimited (despite `.csv` extension).

## MySQL

## DOI

```
SELECT CONCAT("UPDATE `references` SET doi='", doi, "' WHERE containerTitle='Journal of the Hattori Botanical Laboratory' AND volume='", volume, "' AND page='", CONCAT(spage,'–',epage), "';") FROM publications WHERE issn='0073-0912' AND doi IS NOT NULL;
```

### JSTOR

```
SELECT CONCAT("UPDATE `references` SET jstor='", jstor, "' WHERE containerTitle='Lindbergia' AND volume='", volume, "' AND page='", CONCAT(spage,'–',epage), "';") FROM publications WHERE issn='0105-0761' AND jstor IS NOT NULL;
```


## SQLite

```
SELECT "UPDATE `references` SET doi=""" || doi || """ WHERE containerTitle=""Journal of the Hattori Botanical Laboratory"" AND volume=""" || volume || """ AND page=""" || spage || "–" || epage || """;" FROM publications_doi WHERE issn='0073-0912' AND doi IS NOT NULL AND volume IS NOT NULL AND spage IS NOT NULL AND epage IS NOT NULL;
```