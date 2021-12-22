<?php


namespace Experius\SansecReport\Model\Message;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Notification\MessageInterface;
use Magento\Framework\Phrase;
use Magento\Framework\UrlInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Experius\SansecReport\Api\SansecReportsRepositoryInterface;
use Magento\Framework\Encryption\Encryptor;

/**
 * Class Report
 * @package Experius\SansecReport\Model\Message
 */
class Report implements MessageInterface
{

    /**
     * @var SansecReportsRepositoryInterface
     */
    protected $reportsRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var Encryptor
     */
    private $encryptor;

    /**
     * Report constructor.
     * @param SansecReportsRepositoryInterface $reportsRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param UrlInterface $urlBuilder
     * @param Encryptor $encryptor
     * @param DateTime $dateTime
     */
    public function __construct(
        SansecReportsRepositoryInterface $reportsRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        UrlInterface $urlBuilder,
        Encryptor $encryptor,
        DateTime $dateTime
    ) {
        $this->reportsRepository = $reportsRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->urlBuilder = $urlBuilder;
        $this->dateTime = $dateTime;
        $this->encryptor = $encryptor;
    }

    /**
     * Check whether all indices are valid or not
     *
     * @return bool
     * @throws LocalizedException
     */
    public function isDisplayed()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('is_verified', 0, 'eq')
            ->create();
        $count = $this->reportsRepository
            ->getList($searchCriteria)
            ->getTotalCount();
        return $count;
    }

    /**
     * Retrieve unique message identity
     *
     * @return string
     */
    public function getIdentity()
    {
        return $this->encryptor->hash('SANSECREPORTS_NOT_VERIFIED', Encryptor::HASH_VERSION_MD5);
    }

    /**
     * Retrieve message text
     *
     * @return Phrase
     */
    public function getText()
    {
        $url = $this->urlBuilder->getUrl('experius_sansecreport/sansecreports/index');
        //@codingStandardsIgnoreStart
        return __(
            '<a href="%1">Sansec Security Reports</a> - at least one error in the last week!',
            $url
        );
        //@codingStandardsIgnoreEnd
    }

    /**
     * Retrieve message severity
     *
     * @return int
     */
    public function getSeverity()
    {
        return self::SEVERITY_CRITICAL;
    }

}
