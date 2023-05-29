<?php
class ChatTest extends BaseTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->client = new \MessageBird\Client('YOUR_ACCESS_KEY', $this->mockClient);
    }

    public function testCreateChatMessage()
    {
        $ChatMessage = new \MessageBird\Objects\Chat\Message();
        $ChatMessage->contactId = '9d754dac577e3ff103cdf4n29856560';
        $ChatMessage->payload = 'This is a test message to test the Chat API';
        $ChatMessage->type = 'text';

        $this->mockClient->expects($this->atLeastOnce())->method('performHttpRequest')->willReturn(array(200, '', '{"type":"text","payload":"This is a test message to test the Chat API","contactId":"9d754dac577e3ff103cdf4n29856560"}'));
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("POST", 'messages', null, '{"type":"text","payload":"This is a test message to test the Chat API","contactId":"9d754dac577e3ff103cdf4n29856560"}');
        $this->client->chatMessages->create($ChatMessage);
    }

    public function testListChatMessage()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'messages', array ('offset' => 100, 'limit' => 30), null);
        $ChatMessageList = $this->client->chatMessages->getList(array ('offset' => 100, 'limit' => 30));
    }

    public function testReadChatMessage()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'messages/id', null, null);
        $ChatMessageList = $this->client->chatMessages->read("id");
    }


    public function testCreateChatChannel()
    {
        $ChatChannel = new \MessageBird\Objects\Chat\Channel();
        $ChatChannel->name = 'Test Channel Telegram';
        $ChatChannel->platformId = 'e84f332c5649a5f911e569n69330697';

        $ChatChannel->channelDetails =
            array(
                'botName' => 'testBot',
                'token' => '1234566778:A34JT44Yr4amk234352et5hvRnHeAEHA'
            );

        $this->mockClient->expects($this->atLeastOnce())->method('performHttpRequest')->willReturn(array(200, '', '{"name":"Test Channel Telegram","platformId":"e84f332c5649a5f911e569n69330697","channelDetails":{"botName":"testBot","token":"1234566778:A34JT44Yr4amk234352et5hvRnHeAEHA"},"callbackUrl":null}'));
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("POST", 'channels', null, '{"name":"Test Channel Telegram","platformId":"e84f332c5649a5f911e569n69330697","channelDetails":{"botName":"testBot","token":"1234566778:A34JT44Yr4amk234352et5hvRnHeAEHA"},"callbackUrl":null}');
        $this->client->chatChannels->create($ChatChannel);
    }

    public function testListChatChannels()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'channels', array ('offset' => 100, 'limit' => 30), null);
        $ChannelList = $this->client->chatChannels->getList(array ('offset' => 100, 'limit' => 30));
    }

    public function testReadChatChannel()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'channels/id', null, null);
        $Channel = $this->client->chatChannels->read("id");
    }

    public function testDeleteChannel()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("DELETE", 'channels/id', null, null);
        $Channel = $this->client->chatChannels->delete("id");
    }

    public function testUpdateChatChannel()
    {
        $ChatChannel = new \MessageBird\Objects\Chat\Channel();
        $ChatChannel->name = '9d2345ac577e4f103cd3d4529856560';
        $ChatChannel->callbackUrl = 'http://testurl.dev';

        $this->mockClient->expects($this->atLeastOnce())->method('performHttpRequest')->willReturn(array(200, '', '{"name":"9d2345ac577e4f103cd3d4529856560","callbackUrl":"http:\/\/testurl.dev"}'));
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("PUT", 'channels/234agfgADFH2974gaADFH3hudf9h', null, '{"name":"9d2345ac577e4f103cd3d4529856560","callbackUrl":"http:\/\/testurl.dev"}');
        $this->client->chatChannels->update($ChatChannel,'234agfgADFH2974gaADFH3hudf9h');
    }

    public function testListChatPlatforms()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'platforms', array ('offset' => 100, 'limit' => 30), null);
        $ChannelList = $this->client->chatPlatforms->getList(array ('offset' => 100, 'limit' => 30));
    }

    public function testReadChatPlatform()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'platforms/id', null, null);
        $Channel = $this->client->chatPlatforms->read("id");
    }

    public function testListChatContacts()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'contacts', array ('offset' => 100, 'limit' => 30), null);
        $ContactList = $this->client->chatContacts->getList(array ('offset' => 100, 'limit' => 30));
    }

    public function testReadChatContact()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("GET", 'contacts/id', null, null);
        $Contact = $this->client->chatContacts->read("id");
    }

    public function testDeleteContact()
    {
        $this->expectException(\MessageBird\Exceptions\ServerException::class);
        $this->mockClient->expects($this->once())->method('performHttpRequest')->with("DELETE", 'contacts/id', null, null);
        $contact = $this->client->chatContacts->delete("id");
    }
}
