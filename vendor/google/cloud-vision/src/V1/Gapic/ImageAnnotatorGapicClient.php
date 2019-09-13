<?php
/*
 * Copyright 2017 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/*
 * GENERATED CODE WARNING
 * This file was generated from the file
 * https://github.com/google/googleapis/blob/master/google/cloud/vision/v1/image_annotator.proto
 * and updates to that file get reflected here through a refresh process.
 *
 * @experimental
 */

namespace Google\Cloud\Vision\V1\Gapic;

use Google\ApiCore\ApiException;
use Google\ApiCore\CredentialsWrapper;
use Google\ApiCore\GapicClientTrait;
use Google\ApiCore\LongRunning\OperationsClient;
use Google\ApiCore\OperationResponse;
use Google\ApiCore\RequestParamsHeaderDescriptor;
use Google\ApiCore\RetrySettings;
use Google\ApiCore\Transport\TransportInterface;
use Google\ApiCore\ValidationException;
use Google\Auth\FetchAuthTokenInterface;
use Google\Cloud\Vision\V1\AnnotateFileRequest;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\AsyncAnnotateFileRequest;
use Google\Cloud\Vision\V1\AsyncBatchAnnotateFilesRequest;
use Google\Cloud\Vision\V1\AsyncBatchAnnotateFilesResponse;
use Google\Cloud\Vision\V1\AsyncBatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\AsyncBatchAnnotateImagesResponse;
use Google\Cloud\Vision\V1\BatchAnnotateFilesRequest;
use Google\Cloud\Vision\V1\BatchAnnotateFilesResponse;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesResponse;
use Google\Cloud\Vision\V1\OperationMetadata;
use Google\Cloud\Vision\V1\OutputConfig;
use Google\LongRunning\Operation;

/**
 * Service Description: Service that performs Google Cloud Vision API detection tasks over client
 * images, such as face, landmark, logo, label, and text detection. The
 * ImageAnnotator service returns detected entities from the images.
 *
 * This class provides the ability to make remote calls to the backing service through method
 * calls that map to API methods. Sample code to get started:
 *
 * ```
 * $imageAnnotatorClient = new ImageAnnotatorClient();
 * try {
 *     $requests = [];
 *     $response = $imageAnnotatorClient->batchAnnotateImages($requests);
 * } finally {
 *     $imageAnnotatorClient->close();
 * }
 * ```
 *
 * @experimental
 */
class ImageAnnotatorGapicClient
{
    use GapicClientTrait;

    /**
     * The name of the service.
     */
    const SERVICE_NAME = 'google.cloud.vision.v1.ImageAnnotator';

    /**
     * The default address of the service.
     */
    const SERVICE_ADDRESS = 'vision.googleapis.com';

    /**
     * The default port of the service.
     */
    const DEFAULT_SERVICE_PORT = 443;

    /**
     * The name of the code generator, to be included in the agent header.
     */
    const CODEGEN_NAME = 'gapic';

    /**
     * The default scopes required by the service.
     */
    public static $serviceScopes = [
        'https://www.googleapis.com/auth/cloud-platform',
        'https://www.googleapis.com/auth/cloud-vision',
    ];

    private $operationsClient;

    private static function getClientDefaults()
    {
        return [
            'serviceName' => self::SERVICE_NAME,
            'apiEndpoint' => self::SERVICE_ADDRESS.':'.self::DEFAULT_SERVICE_PORT,
            'clientConfig' => __DIR__.'/../resources/image_annotator_client_config.json',
            'descriptorsConfigPath' => __DIR__.'/../resources/image_annotator_descriptor_config.php',
            'gcpApiConfigPath' => __DIR__.'/../resources/image_annotator_grpc_config.json',
            'credentialsConfig' => [
                'scopes' => self::$serviceScopes,
            ],
            'transportConfig' => [
                'rest' => [
                    'restClientConfigPath' => __DIR__.'/../resources/image_annotator_rest_client_config.php',
                ],
            ],
        ];
    }

    /**
     * Return an OperationsClient object with the same endpoint as $this.
     *
     * @return OperationsClient
     * @experimental
     */
    public function getOperationsClient()
    {
        return $this->operationsClient;
    }

    /**
     * Resume an existing long running operation that was previously started
     * by a long running API method. If $methodName is not provided, or does
     * not match a long running API method, then the operation can still be
     * resumed, but the OperationResponse object will not deserialize the
     * final response.
     *
     * @param string $operationName The name of the long running operation
     * @param string $methodName    The name of the method used to start the operation
     *
     * @return OperationResponse
     * @experimental
     */
    public function resumeOperation($operationName, $methodName = null)
    {
        $options = isset($this->descriptors[$methodName]['longRunning'])
            ? $this->descriptors[$methodName]['longRunning']
            : [];
        $operation = new OperationResponse($operationName, $this->getOperationsClient(), $options);
        $operation->reload();

        return $operation;
    }

    /**
     * Constructor.
     *
     * @param array $options {
     *                       Optional. Options for configuring the service API wrapper.
     *
     *     @type string $serviceAddress
     *           **Deprecated**. This option will be removed in a future major release. Please
     *           utilize the `$apiEndpoint` option instead.
     *     @type string $apiEndpoint
     *           The address of the API remote host. May optionally include the port, formatted
     *           as "<uri>:<port>". Default 'vision.googleapis.com:443'.
     *     @type string|array|FetchAuthTokenInterface|CredentialsWrapper $credentials
     *           The credentials to be used by the client to authorize API calls. This option
     *           accepts either a path to a credentials file, or a decoded credentials file as a
     *           PHP array.
     *           *Advanced usage*: In addition, this option can also accept a pre-constructed
     *           {@see \Google\Auth\FetchAuthTokenInterface} object or
     *           {@see \Google\ApiCore\CredentialsWrapper} object. Note that when one of these
     *           objects are provided, any settings in $credentialsConfig will be ignored.
     *     @type array $credentialsConfig
     *           Options used to configure credentials, including auth token caching, for the client.
     *           For a full list of supporting configuration options, see
     *           {@see \Google\ApiCore\CredentialsWrapper::build()}.
     *     @type bool $disableRetries
     *           Determines whether or not retries defined by the client configuration should be
     *           disabled. Defaults to `false`.
     *     @type string|array $clientConfig
     *           Client method configuration, including retry settings. This option can be either a
     *           path to a JSON file, or a PHP array containing the decoded JSON data.
     *           By default this settings points to the default client config file, which is provided
     *           in the resources folder.
     *     @type string|TransportInterface $transport
     *           The transport used for executing network requests. May be either the string `rest`
     *           or `grpc`. Defaults to `grpc` if gRPC support is detected on the system.
     *           *Advanced usage*: Additionally, it is possible to pass in an already instantiated
     *           {@see \Google\ApiCore\Transport\TransportInterface} object. Note that when this
     *           object is provided, any settings in $transportConfig, and any `$apiEndpoint`
     *           setting, will be ignored.
     *     @type array $transportConfig
     *           Configuration options that will be used to construct the transport. Options for
     *           each supported transport type should be passed in a key for that transport. For
     *           example:
     *           $transportConfig = [
     *               'grpc' => [...],
     *               'rest' => [...]
     *           ];
     *           See the {@see \Google\ApiCore\Transport\GrpcTransport::build()} and
     *           {@see \Google\ApiCore\Transport\RestTransport::build()} methods for the
     *           supported options.
     * }
     *
     * @throws ValidationException
     * @experimental
     */
    public function __construct(array $options = [])
    {
        $clientOptions = $this->buildClientOptions($options);
        $this->setClientOptions($clientOptions);
        $this->operationsClient = $this->createOperationsClient($clientOptions);
    }

    /**
     * Run image detection and annotation for a batch of images.
     *
     * Sample code:
     * ```
     * $imageAnnotatorClient = new ImageAnnotatorClient();
     * try {
     *     $requests = [];
     *     $response = $imageAnnotatorClient->batchAnnotateImages($requests);
     * } finally {
     *     $imageAnnotatorClient->close();
     * }
     * ```
     *
     * @param AnnotateImageRequest[] $requests     Individual image annotation requests for this batch.
     * @param array                  $optionalArgs {
     *                                             Optional.
     *
     *     @type string $parent
     *          Optional. Target project and location to make a call.
     *
     *          Format: `projects/{project-id}/locations/{location-id}`.
     *
     *          If no parent is specified, a region will be chosen automatically.
     *
     *          Supported location-ids:
     *              `us`: USA country only,
     *              `asia`: East asia areas, like Japan, Taiwan,
     *              `eu`: The European Union.
     *
     *          Example: `projects/project-A/locations/eu`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\BatchAnnotateImagesResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function batchAnnotateImages($requests, array $optionalArgs = [])
    {
        $request = new BatchAnnotateImagesRequest();
        $request->setRequests($requests);
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'BatchAnnotateImages',
            BatchAnnotateImagesResponse::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Service that performs image detection and annotation for a batch of files.
     * Now only "application/pdf", "image/tiff" and "image/gif" are supported.
     *
     * This service will extract at most 5 (customers can specify which 5 in
     * AnnotateFileRequest.pages) frames (gif) or pages (pdf or tiff) from each
     * file provided and perform detection and annotation for each image
     * extracted.
     *
     * Sample code:
     * ```
     * $imageAnnotatorClient = new ImageAnnotatorClient();
     * try {
     *     $requests = [];
     *     $response = $imageAnnotatorClient->batchAnnotateFiles($requests);
     * } finally {
     *     $imageAnnotatorClient->close();
     * }
     * ```
     *
     * @param AnnotateFileRequest[] $requests     The list of file annotation requests. Right now we support only one
     *                                            AnnotateFileRequest in BatchAnnotateFilesRequest.
     * @param array                 $optionalArgs {
     *                                            Optional.
     *
     *     @type string $parent
     *          Optional. Target project and location to make a call.
     *
     *          Format: `projects/{project-id}/locations/{location-id}`.
     *
     *          If no parent is specified, a region will be chosen automatically.
     *
     *          Supported location-ids:
     *              `us`: USA country only,
     *              `asia`: East asia areas, like Japan, Taiwan,
     *              `eu`: The European Union.
     *
     *          Example: `projects/project-A/locations/eu`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\Cloud\Vision\V1\BatchAnnotateFilesResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function batchAnnotateFiles($requests, array $optionalArgs = [])
    {
        $request = new BatchAnnotateFilesRequest();
        $request->setRequests($requests);
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startCall(
            'BatchAnnotateFiles',
            BatchAnnotateFilesResponse::class,
            $optionalArgs,
            $request
        )->wait();
    }

    /**
     * Run asynchronous image detection and annotation for a list of images.
     *
     * Progress and results can be retrieved through the
     * `google.longrunning.Operations` interface.
     * `Operation.metadata` contains `OperationMetadata` (metadata).
     * `Operation.response` contains `AsyncBatchAnnotateImagesResponse` (results).
     *
     * This service will write image annotation outputs to json files in customer
     * GCS bucket, each json file containing BatchAnnotateImagesResponse proto.
     *
     * Sample code:
     * ```
     * $imageAnnotatorClient = new ImageAnnotatorClient();
     * try {
     *     $requests = [];
     *     $outputConfig = new OutputConfig();
     *     $operationResponse = $imageAnnotatorClient->asyncBatchAnnotateImages($requests, $outputConfig);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *         // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $imageAnnotatorClient->asyncBatchAnnotateImages($requests, $outputConfig);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $imageAnnotatorClient->resumeOperation($operationName, 'asyncBatchAnnotateImages');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *       $result = $newOperationResponse->getResult();
     *       // doSomethingWith($result)
     *     } else {
     *       $error = $newOperationResponse->getError();
     *       // handleError($error)
     *     }
     * } finally {
     *     $imageAnnotatorClient->close();
     * }
     * ```
     *
     * @param AnnotateImageRequest[] $requests     Individual image annotation requests for this batch.
     * @param OutputConfig           $outputConfig Required. The desired output location and metadata (e.g. format).
     * @param array                  $optionalArgs {
     *                                             Optional.
     *
     *     @type string $parent
     *          Optional. Target project and location to make a call.
     *
     *          Format: `projects/{project-id}/locations/{location-id}`.
     *
     *          If no parent is specified, a region will be chosen automatically.
     *
     *          Supported location-ids:
     *              `us`: USA country only,
     *              `asia`: East asia areas, like Japan, Taiwan,
     *              `eu`: The European Union.
     *
     *          Example: `projects/project-A/locations/eu`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function asyncBatchAnnotateImages($requests, $outputConfig, array $optionalArgs = [])
    {
        $request = new AsyncBatchAnnotateImagesRequest();
        $request->setRequests($requests);
        $request->setOutputConfig($outputConfig);
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startOperationsCall(
            'AsyncBatchAnnotateImages',
            $optionalArgs,
            $request,
            $this->getOperationsClient()
        )->wait();
    }

    /**
     * Run asynchronous image detection and annotation for a list of generic
     * files, such as PDF files, which may contain multiple pages and multiple
     * images per page. Progress and results can be retrieved through the
     * `google.longrunning.Operations` interface.
     * `Operation.metadata` contains `OperationMetadata` (metadata).
     * `Operation.response` contains `AsyncBatchAnnotateFilesResponse` (results).
     *
     * Sample code:
     * ```
     * $imageAnnotatorClient = new ImageAnnotatorClient();
     * try {
     *     $requests = [];
     *     $operationResponse = $imageAnnotatorClient->asyncBatchAnnotateFiles($requests);
     *     $operationResponse->pollUntilComplete();
     *     if ($operationResponse->operationSucceeded()) {
     *         $result = $operationResponse->getResult();
     *         // doSomethingWith($result)
     *     } else {
     *         $error = $operationResponse->getError();
     *         // handleError($error)
     *     }
     *
     *
     *     // Alternatively:
     *
     *     // start the operation, keep the operation name, and resume later
     *     $operationResponse = $imageAnnotatorClient->asyncBatchAnnotateFiles($requests);
     *     $operationName = $operationResponse->getName();
     *     // ... do other work
     *     $newOperationResponse = $imageAnnotatorClient->resumeOperation($operationName, 'asyncBatchAnnotateFiles');
     *     while (!$newOperationResponse->isDone()) {
     *         // ... do other work
     *         $newOperationResponse->reload();
     *     }
     *     if ($newOperationResponse->operationSucceeded()) {
     *       $result = $newOperationResponse->getResult();
     *       // doSomethingWith($result)
     *     } else {
     *       $error = $newOperationResponse->getError();
     *       // handleError($error)
     *     }
     * } finally {
     *     $imageAnnotatorClient->close();
     * }
     * ```
     *
     * @param AsyncAnnotateFileRequest[] $requests     Individual async file annotation requests for this batch.
     * @param array                      $optionalArgs {
     *                                                 Optional.
     *
     *     @type string $parent
     *          Optional. Target project and location to make a call.
     *
     *          Format: `projects/{project-id}/locations/{location-id}`.
     *
     *          If no parent is specified, a region will be chosen automatically.
     *
     *          Supported location-ids:
     *              `us`: USA country only,
     *              `asia`: East asia areas, like Japan, Taiwan,
     *              `eu`: The European Union.
     *
     *          Example: `projects/project-A/locations/eu`.
     *     @type RetrySettings|array $retrySettings
     *          Retry settings to use for this call. Can be a
     *          {@see Google\ApiCore\RetrySettings} object, or an associative array
     *          of retry settings parameters. See the documentation on
     *          {@see Google\ApiCore\RetrySettings} for example usage.
     * }
     *
     * @return \Google\ApiCore\OperationResponse
     *
     * @throws ApiException if the remote call fails
     * @experimental
     */
    public function asyncBatchAnnotateFiles($requests, array $optionalArgs = [])
    {
        $request = new AsyncBatchAnnotateFilesRequest();
        $request->setRequests($requests);
        if (isset($optionalArgs['parent'])) {
            $request->setParent($optionalArgs['parent']);
        }

        $requestParams = new RequestParamsHeaderDescriptor([
          'parent' => $request->getParent(),
        ]);
        $optionalArgs['headers'] = isset($optionalArgs['headers'])
            ? array_merge($requestParams->getHeader(), $optionalArgs['headers'])
            : $requestParams->getHeader();

        return $this->startOperationsCall(
            'AsyncBatchAnnotateFiles',
            $optionalArgs,
            $request,
            $this->getOperationsClient()
        )->wait();
    }
}
