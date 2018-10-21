<?php
namespace App\EventListener;
use App\Entity\Locale;
use App\Repository\LocaleRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Gedmo\Translatable\TranslatableListener;

class LocaleListener implements EventSubscriberInterface
{
    private $availableLocales;
    private $defaultLocale;
    private $translatableListener;
    protected $currentLocale;
    public function __construct(TranslatableListener $translatableListener, LocaleRepository $localeRepository)
    {
        $this->translatableListener = $translatableListener;
        $this->availableLocales = $localeRepository->getAvailableLocales();
        $this->defaultLocale = $localeRepository->getDefaultLocale();
    }
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 200)),
            KernelEvents::RESPONSE => array('setContentLanguage')
        );
    }
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Persist DefaultLocale in translation table
        $this->translatableListener->setPersistDefaultLocaleTranslation(true);
        /** @var Request $request */
        $request = $event->getRequest();
        if ($request->headers->has("X-LOCALE")) {
            $locale = $request->headers->get('X-LOCALE');
            if (in_array($locale, $this->availableLocales)) {
                $request->setLocale($locale);
            } else {
                $request->setLocale($this->defaultLocale);
            }
        } else {
            $request->setLocale($this->defaultLocale);
        }
        // Set currentLocale
        $this->translatableListener->setTranslatableLocale($request->getLocale());
        $this->currentLocale = $request->getLocale();
    }
    /**
     * @param FilterResponseEvent $event
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function setContentLanguage(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $response->headers->add(array('Content-Language' => $this->currentLocale));
        return $response;
    }
}