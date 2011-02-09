<?php

namespace Bundle\SearchBundle\Lucene;

use Bundle\SearchBundle\Lucene\Lucene;
use Zend\Search\Lucene\Analysis\Analyzer\Analyzer;
use Zend\Search\Lucene\Index\Term;

class LuceneSearch
{
    protected $index;

    /**
     * Instanciate the Auth service
     *
     * @param string   $luceneIndexPath
     * @param Analyzer $analyzer
     */
    public function __construct($luceneIndexPath, $analyzer)
    {
        if (file_exists($luceneIndexPath)) {
            $this->index = Lucene::open($luceneIndexPath);
        } else {
            $this->index = Lucene::create($luceneIndexPath);
        }

        if (isset($analyzer)) {
            Analyzer::setDefault(new $analyzer);
        }
    }

    public function getIndex() {
        return $this->index;
    }

    /**
     *  addDocument
     *
     *  This is a convience function to add a document to the index
     *
     * @param Bundle\SearchBundle\Lucene\Document $document
     */
    public function addDocument($document)
    {
        $this->deleteDocument($document);
        $this->index->addDocument($document);
    }

    /**
     * updateIndex
     *
     * A convience function to commit and optimize the index
     */
    public function updateIndex()
    {
        $this->index->commit();
        $this->index->optimize();
    }

    public function find($query)
    {
        return $this->index->find($query);
    }

    public function updateDocument($document)
    {
        $this->addDocument($document);
    }

    public function deleteDocument($document)
    {
        // Search for documents with the same Key value.
        $term = new Term($document->key, 'key');
        $docIds = $this->index->termDocs($term);

        // Delete any documents found.
        foreach ($docIds as $id) {
            $this->index->delete($id);
        }
    }
}
