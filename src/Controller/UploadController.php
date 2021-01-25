<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\FileUploader;
use Psr\Log\LoggerInterface;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function index()
    {
        return $this->render('upload/index.html.twig', [
            'filename' => null,
            'jsonstring' => null,
        ]);
    }

    /**
     * @Route("/doUpload", name="do-upload")
     * @param Request $request
     * @param string $uploadDir
     * @param FileUploader $uploader
     * @param LoggerInterface $logger
     * @return Response
     */
    public function doUpload(Request $request, string $uploadDir,
                             FileUploader $uploader, LoggerInterface $logger): Response
    {
        $token = $request->get("token");

        if (!$this->isCsrfTokenValid('upload', $token)) {
            $logger->info("CSRF failure");

            return new Response("Operation not allowed", Response::HTTP_BAD_REQUEST,
                ['content-type' => 'text/plain']);
        }

        $file = $request->files->get('myfile');

        if (empty($file)) {
            return new Response("No file specified",
                Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
        }

        $filename = $file->getClientOriginalName();
        $uploader->upload($uploadDir, $file, $filename);

        /*
         Code van Henry:
         */

        $content = utf8_encode(file_get_contents($uploadDir . '/' . $filename));  // load with UTF8
        $xml = simplexml_load_string($content);

        $products = [];

        foreach ($xml as $product) {
            // Manier 1
            $products[] = (array)$product;

            // Manier 2

            /*$tmpProduct = [];

            foreach ($product as $key => $value) {
                $tmpProduct[$key] = current($value);
            }

            $products[] = $tmpProduct;
*/
        }

        foreach ($products as $product) {
            var_dump($product);
            $gr = new Product();
            $gr->setCode((int)$product['isbn']);
            $gr->setFilename(null);
            $gr->setImage(null);
            $gr->setImageFile(null);
            $gr->setOmschrijving($product['discription']);
            $gr->setPrijs(floatval($product['price']));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gr);
            $entityManager->flush();
        }


        return $this->render('default/index.html.twig');
    }
}